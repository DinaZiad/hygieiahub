<?php

namespace App\Http\Controllers;

use App\Models\QuestionnaireOne;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class QuestionnaireOneController extends Controller
{
    // Cache duration in seconds (10 minutes)
    private const CACHE_DURATION = 600;

    // Predefined items array to avoid recreating it on each request
    private $predefinedItems = [
        'Bed Linen' => [
            'King Fitted Sheets',
            'King Flat Sheets',
            'King Duvet Covers',
            'King Mattress Protector',
            'Queen Fitted Sheets',
            'Queen Flat Sheets',
            'Queen Duvet Covers',
            'Queen Mattress Protector',
            'Single Fitted Sheets',
            'Single Flat Sheets',
            'Single Duvet Covers',
            'Single Mattress Protector'
        ],
        'Bathroom Linen' => [
            'Bath Towels',
            'Hand Towels',
            'Face Towel',
            'Pool Towel',
            'Bath Mats',
            'Bath Robe',
        ],
    ];

    public function create()
    {
        // Cache supervisors list to avoid repeated database queries
        $supervisors = Cache::remember('supervisors', self::CACHE_DURATION, function () {
            return User::where('role', 'supervisor')->get();
        });

        return view('questionnaire1.create', [
            'items' => $this->predefinedItems,
            'supervisors' => $supervisors
        ]);
    }

    public function store(Request $request)
    {
        // Validate the request first
        $validated = $request->validate([
            'housekeeper_name' => 'required|string|max:255',
            'unit_number' => 'required|string|max:255',
            'service_type' => 'required|string',
            'provided_items' => 'nullable|array',
            'removed_items' => 'nullable|array',
            'tasks' => 'nullable|array',
            'task_date' => 'required|date',
            'supervisor_id' => 'required|exists:users,id',
            'images' => 'nullable|array',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // 2MB max per image
        ]);

        // Handle image uploads with optimization
        $images = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                // Optimize and resize the image before storing
                $optimizedImage = Image::make($image)
                    ->resize(800, null, function ($constraint) {
                        $constraint->aspectRatio();
                        $constraint->upsize();
                    })
                    ->encode('jpg', 80); // Convert to JPG with 80% quality

                $filename = 'images/' . time() . '_' . uniqid() . '.jpg';
                Storage::disk('public')->put($filename, $optimizedImage);
                $images[] = $filename;
            }
        }

        // Prepare data for database
        $data = [
            'housekeeper_name' => $validated['housekeeper_name'],
            'unit_number' => $validated['unit_number'],
            'service_type' => $validated['service_type'],
            'provided_items' => json_encode($request->provided_items ?? []),
            'removed_items' => json_encode($request->removed_items ?? []),
            'bathroom_tasks' => json_encode($request->tasks['bathroom'] ?? []),
            'general_tasks' => json_encode($request->tasks['general'] ?? []),
            'bedroom_tasks' => json_encode($request->tasks['bedroom'] ?? []),
            'task_date' => $validated['task_date'],
            'user_id' => Auth::id(),
            'status_remarks' => "Null",
            'supervisor_id' => $validated['supervisor_id'],
        ];

        // Add images to data if they exist
        if (!empty($images)) {
            $data['images'] = json_encode($images);
        }

        // Create the record
        QuestionnaireOne::create($data);

        // Clear any related caches
        Cache::forget('questionnaire_one_' . Auth::id());

        return redirect()->route('questionnaire1.create')->with('success', 'Form submitted successfully.');
    }

    public function index(Request $request)
    {
        // Create a cache key based on the request parameters
        $cacheKey = 'questionnaire_one_' . Auth::id() . '_' .
                   ($request->housekeeper_id ?? 'all') . '_' .
                   ($request->start_date ?? 'no_start') . '_' .
                   ($request->end_date ?? 'no_end');

        // Try to get data from cache first
        $viewData = Cache::remember($cacheKey, self::CACHE_DURATION, function () use ($request) {
            $query = QuestionnaireOne::query()
                ->select('questionnaire_ones.*', 'users.name as user_name', 'users.role as user_role')
                ->join('users', 'questionnaire_ones.user_id', '=', 'users.id')
                ->where('questionnaire_ones.supervisor_id', Auth::id())
                ->where('users.role', 'housekeeper');

            // Apply filters
            if ($request->filled('housekeeper_id')) {
                $query->where('questionnaire_ones.user_id', $request->housekeeper_id);
            }

            if ($request->filled('start_date')) {
                $query->whereDate('questionnaire_ones.task_date', '>=', $request->start_date);
            }

            if ($request->filled('end_date')) {
                $query->whereDate('questionnaire_ones.task_date', '<=', $request->end_date);
            }

            // Get paginated results instead of all at once
            $entries = $query->latest()->paginate(15);

            // Get housekeepers for dropdown (cached separately)
            $housekeepers = Cache::remember('housekeepers', self::CACHE_DURATION, function () {
                return User::where('role', 'housekeeper')->get();
            });

            return [
                'entries' => $entries,
                'housekeepers' => $housekeepers
            ];
        });

        return view('supervisor.questionnaire1.index', $viewData);
    }


    public function updateStatus(Request $request, $id)
    {
        $questionnaire = QuestionnaireOne::findOrFail($id);

        // Ensure the user has permission to approve
        if ($questionnaire->supervisor_id !== Auth::id()) {
            return redirect()->back()->with('error', 'You do not have permission to approve this questionnaire');
        }

        $questionnaire->status = $request->status;
        $questionnaire->save();

        return redirect()->back()->with('success', 'Status updated successfully');
    }

}
