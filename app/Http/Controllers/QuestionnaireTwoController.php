<?php

namespace App\Http\Controllers;

use App\Models\Questionnaire2;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class QuestionnaireTwoController extends Controller
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
        return view('questionnaire2.create', ['items' => $this->predefinedItems]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'housekeeper_name' => 'required|string|max:255',
            'unit_number' => 'required|string|max:255',
            'service_type' => 'required|string',
            'bed_linen' => 'nullable|array',
            'bath_linen' => 'nullable|array',
            'task_date' => 'required|date',
        ]);

        // Prepare data for database
        $data = [
            'housekeeper_name' => $validated['housekeeper_name'],
            'unit_number' => $validated['unit_number'],
            'service_type' => $validated['service_type'],
            'bed_linen' => json_encode($request->bed_linen ?? []),
            'bath_linen' => json_encode($request->bath_linen ?? []),
            'task_date' => $validated['task_date'],
            'user_id' => Auth::id(),
            'status_remarks' => "Null",
        ];

        // Create the record
        Questionnaire2::create($data);

        // Clear any related caches
        Cache::forget('questionnaire2_all');
        Cache::forget('questionnaire2_delivered');

        return redirect()->route('questionnaire2.create')->with('success', 'Form submitted successfully.');
    }

    public function index()
    {
        // Cache the results to avoid repeated database queries
        $entries = Cache::remember('questionnaire2_all', self::CACHE_DURATION, function () {
            return Questionnaire2::latest()->paginate(15);
        });

        return view('questionnaire2.index', compact('entries'));
    }

    public function updateStatus(Request $request, $id)
    {
        $entry = Questionnaire2::findOrFail($id);
        $entry->status = $request->status;

        if ($request->status == "delivered") {
            $entry->note = null;
        }

        $entry->save();

        // Clear caches after update
        Cache::forget('questionnaire2_all');
        Cache::forget('questionnaire2_delivered');

        return back()->with('success', 'Status updated.');
    }

    public function delivered()
    {
        // Cache the results to avoid repeated database queries
        $entries = Cache::remember('questionnaire2_delivered', self::CACHE_DURATION, function () {
            return Questionnaire2::whereIn('status', ['delivered', 'partially deliver'])
                ->latest()
                ->paginate(15);
        });

        return view('supervisor.questionnaire2.delivered', compact('entries'));
    }


    public function submitNote(Request $request, $id)
    {
        $request->validate([
            'note' => 'required|string|max:200',
        ]);



    // Add error handling for validation
    if ($request->session()->has('errors')) {
        return redirect()->back()->withErrors($request->session()->get('errors'))->withInput();
    }
        $entry = Questionnaire2::findOrFail($id);
        $entry->note = $request->note;
        $entry->save();

        return redirect()->back()->with('success', 'Note submitted successfully.');
    }
}
