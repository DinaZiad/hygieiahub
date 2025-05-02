<?php

use App\Exports\dataExport;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Questionnaire2Controller;
use App\Http\Controllers\QuestionnaireOneController;
use App\Http\Controllers\QuestionnaireTwoController;
use App\Http\Middleware\RoleMiddleware;
use App\Models\Questionnaire2;
use App\Models\QuestionnaireOne;
use Illuminate\Support\Facades\Route;
use Maatwebsite\Excel\Facades\Excel;

Route::get('/', function () {
    return redirect()->route('login');

});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/admin/dash', function () {
        return view('admin.dash');
    })->name('admin.dash');

    Route::get('/supervisor/dash', function () {
        return view('supervisor.dash');
    })->name('supervisor.dash');

    Route::get('/laundary/dash', function () {
        return view('laundry.dash');
    })->name('laundry.dash');

    Route::get('/housekeeper/dash', function () {
        return view('housekeeper.dash');
    })->name('housekeeper.dash');
});

Route::middleware(['auth', RoleMiddleware::class . ':supervisor'])->group(function () {

    Route::get('/questionnaire1/index', [QuestionnaireOneController::class, 'index'])->name('questionnaire1.index');
    Route::patch('questionnaire1/{id}/status' , [QuestionnaireOneController::class, 'updateStatus'])->name('questionnaire1.updateStatus');
    // for quesionare 2
    Route::get('/questionnaire2/create', [QuestionnaireTwoController::class, 'create'])->name('questionnaire2.create');
    Route::post('/questionnaire2/store', [QuestionnaireTwoController::class, 'store'])->name('questionnaire2.store');


    Route::get('supervisor/questionnaire2/delivered', [QuestionnaireTwoController::class, 'delivered'])->name('questionnaire2.notes');
});

Route::middleware(['auth', RoleMiddleware::class . ':housekeeper'])->group(function () {
    Route::get('/housekeeper/questionnaire1/create', [QuestionnaireOneController::class, 'create'])->name('questionnaire1.create');
    Route::post('/housekeeper/questionnaire1/store', [QuestionnaireOneController::class, 'store'])->name('questionnaire1.store');
});

Route::middleware('auth')->group(function () {
    Route::get('/laundry/questionnaire2', [QuestionnaireTwoController::class, 'index'])->name('questionnaire2.index');
    Route::patch('/laundry/questionnaire2/{id}/status', [QuestionnaireTwoController::class, 'updateStatus'])->name('questionnaire2.updateStatus');
    // Route::post('/supervisor/questionnaire2/sendNote/{id}', [QuestionnaireTwoController::class, 'sendNote'])->name('questionnaire2.submitNote');
    Route::post('/questionnaire2/{id}/submit-note', [QuestionnaireTwoController::class, 'submitNote'])->name('questionnaire2.submitNote');



});

Route::middleware(['auth', RoleMiddleware::class . ':admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dash');
    Route::patch('/admin/upate-role/{id}', [AdminController::class, 'update_role'])->name('users.updateRole');
    Route::delete('/admin/delete-user/{id}', [AdminController::class, 'delete_user'])->name('users.delete');
    Route::delete('/admin/delete-questionnaire1/{id}', [AdminController::class, 'delete_questionnaire1'])->name('questionnaire1.delete');
    Route::delete('/admin/delete-questionnaire2/{id}', [AdminController::class, 'delete_questionnaire2'])->name('questionnaire2.delete');
});

// for testing puprosees only   
Route::get('/data', function () {
    $data = Questionnaire2::all();
    return response()->json($data);
});

Route::get('/dataa', function () {
    $data = QuestionnaireOne::all();
    return response()->json($data);
});


Route::get('/clear-config', function () {
    Artisan::call('config:clear');
    Artisan::call('config:cache');
    return 'Config cache cleared and rebuilt!';
});

Route::get('/export', [AdminController::class, 'export'])->name('export.report');

require __DIR__.'/auth.php';
    