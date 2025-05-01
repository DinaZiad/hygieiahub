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
    function index()
    {

         $users = User::all()->where('role', '!=', 'admin');
         $ques1 = QuestionnaireOne::all();
         $ques2 = Questionnaire2::all();
         $inspectedQues = QuestionnaireOne::where('status', 'Inspected')->count();
         $approvedQues = Questionnaire2::where('status', 'Approved')->count();
         $deliveredQues = Questionnaire2::where('status', 'Delivered')->count();
         $partiallyDeliveredQues = Questionnaire2::where('status', 'Partially Delivered')->count();

        return view('admin.dash', data : [
            'users' => $users,
            'ques1' => $ques1,
            'ques2' => $ques2,
            'inspectedQues' => $inspectedQues,
            'approvedQues' => $approvedQues,
            'deliveredQues' => $deliveredQues,
            'partiallyDeliveredQues' => $partiallyDeliveredQues
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
