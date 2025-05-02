<?php

namespace App\Http\Controllers;

use App\Exports\dataExport;
use App\Models\Questionnaire2;
use App\Models\QuestionnaireOne;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class AdminController extends Controller
{
    function index(Request $request)
    {

         $users = User::all()->where('role', '!=', 'admin');
         $search = $request->input('search');
         // Search for both questionnaires by unit number
         $ques1 = $search ? 
            QuestionnaireOne::where('unit_number', 'like', '%' . $search . '%')->get() : 
            QuestionnaireOne::all()->reverse();
            
         $ques2 = $search ? 
            Questionnaire2::where('unit_number', 'like', '%' . $search . '%')->get() : 
            Questionnaire2::all()->reverse();

         $inspectedQues = QuestionnaireOne::where('status', 'Inspected')->count();
         $approvedQues = Questionnaire2::where('status', 'Approved')->count();
         $deliveredQues = Questionnaire2::where('status', 'Delivered')->count();
         $partiallyDeliveredQues = Questionnaire2::where('status', 'Partially Delivered')->count();

         // Get today's submissions count
         $today = Carbon::today();
         $todayQues1 = QuestionnaireOne::whereDate('created_at', $today)->count();
         $todayQues2 = Questionnaire2::whereDate('created_at', $today)->count();

        return view('admin.dash', [
            'users' => $users,
            'ques1' => $ques1,
            'ques2' => $ques2,
            'inspectedQues' => $inspectedQues,
            'approvedQues' => $approvedQues,
            'deliveredQues' => $deliveredQues,
            'partiallyDeliveredQues' => $partiallyDeliveredQues,
            'todayQues1' => $todayQues1,
            'todayQues2' => $todayQues2,
            'search' => $search
        ]);
    }

    function update_role(Request $request, $id)
    {
        $user = User::find($id);
        $user->role = $request->input('role');
        $user->save();

        return redirect()->back()->with('success', 'User role updated successfully.');
    }
    function delete_user($id)
    {
        $user = User::find($id);
        $user->delete();

        return redirect()->back()->with('success', 'User deleted successfully.');
    }
    function delete_questionnaire1($id)
    {
        $questionnaire = QuestionnaireOne::find($id);
        $questionnaire->delete();

        return redirect()->back()->with('success', 'Questionnaire 1 deleted successfully.');
    }
    function delete_questionnaire2($id)
    {
        $questionnaire = Questionnaire2::find($id);
        $questionnaire->delete();

        return redirect()->back()->with('success', 'Questionnaire 2 deleted successfully.');
    }




    public function export()
    {
     
        return Excel::download(new dataExport(), 'weekly_report.xlsx');

    }

}
