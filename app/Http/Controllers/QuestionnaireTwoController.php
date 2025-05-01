<?php

namespace App\Http\Controllers;

use App\Models\Questionnaire2;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuestionnaireTwoController extends Controller
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

    return view('questionnaire2.create', compact('items'));
}

public function store(Request $request)
{
    $validated = $request->validate([
        'housekeeper_name' => 'required|string|max:255',
        'unit_number' => 'required|string|max:255',
        'service_type' => 'required|string',
        'status_remarks' => 'required|string',
        'bed_linen' => 'nullable|array',
        'bath_linen' => 'nullable|array',
        'image' => 'nullable|image|max:2048',
        'task_date' => 'required|date',
    ]);

    // Add error handling for validation
    if ($request->session()->has('errors')) {
        return redirect()->back()->withErrors($request->session()->get('errors'))->withInput();
    }

    // Handle image upload
    if ($request->hasFile('image')) {
        $validated['image'] = $request->file('image')->store('uploads', 'public');
    }

    $validated['bed_linen'] = json_encode($request->bed_linen);
    $validated['bath_linen'] = json_encode($request->bath_linen);
   

    $validated['user_id'] = Auth::id();

    Questionnaire2::create($validated);

    return redirect()->route('questionnaire2.create')->with('success', 'Form submitted successfully.');
}

    
    public function index()
    {
        $entries = Questionnaire2::latest()->get();
        return view('questionnaire2.index', compact('entries'));
    }

    public function updateStatus(Request $request, $id)
    {
        $entry = Questionnaire2::findOrFail($id);
        $entry->status = $request->status;
        if($request->status=="delivered"){
            $entry->note = null;
        }
        $entry->save();

        return back()->with('success', 'Status updated.');
    }


    function delivered()
    {
       
        $entries = Questionnaire2::whereIn('status', ['delivered', 'partially deliver'])->latest()->get();
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
