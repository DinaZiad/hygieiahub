<?php

namespace App\Http\Controllers;

use App\Models\QuestionnaireOne;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class QuestionnaireOneController extends Controller
{
    public function create()
    {
        $items = [
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

    $supervisors = User::where('role', 'supervisor')->get();


        return view('questionnaire1.create', compact('items', 'supervisors'));
    }

    public function store(Request $request)
    {
        // Handle image uploads first
        $images = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('images', 'public');
                $images[] = $path;
            }
        }

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

        // Add error handling for validation
        if ($request->session()->has('errors')) {
            return redirect()->back()->withErrors($request->session()->get('errors'))->withInput();
        }

        $validated['provided_items'] = json_encode($request->provided_items);
        $validated['removed_items'] = json_encode($request->removed_items);
        $validated['bathroom_tasks'] = json_encode($request->tasks['bathroom'] ?? []);
        $validated['general_tasks'] = json_encode($request->tasks['general'] ?? []);
        $validated['bedroom_tasks'] = json_encode($request->tasks['bedroom'] ?? []);

        // Add images to validated data if they exist
        if (!empty($images)) {
            $validated['images'] = json_encode($images); 
        }

        $validated['user_id'] = Auth::id();
        $validated['status_remarks'] = "Null";
        $validated['supervisor_id'] = $request->supervisor_id;
        QuestionnaireOne::create($validated);

        return redirect()->route('questionnaire1.create')->with('success', 'Form submitted successfully.');
    }


    public function index(Request $request)
    {
        $query = QuestionnaireOne::query()->with('user')->where('supervisor_id', Auth::id());
        
        // Only show entries created by users with role "housekeeper"
        $query->whereHas('user', function($q) {
            $q->where('role', 'housekeeper');
        });
        
        // Filter by housekeeper ID
        if ($request->filled('housekeeper_id')) {
            $query->where('user_id', $request->housekeeper_id);
        }
        
        // Filter by date range
        if ($request->filled('start_date')) {
            $query->whereDate('task_date', '>=', $request->start_date);
        }
        
        if ($request->filled('end_date')) {
            $query->whereDate('task_date', '<=', $request->end_date);
        }
        
        $entries = $query->latest()->get();
        
        // Get all housekeepers for the dropdown
        $housekeepers = \App\Models\User::where('role', 'housekeeper')->get();
        
        return view('supervisor.questionnaire1.index', compact('entries', 'housekeepers'));
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
