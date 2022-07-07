<?php

use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\web\ExamController;
use App\Http\Controllers\web\HomeController;
use App\Http\Controllers\web\LangController;
use App\Http\Controllers\Admin\CatController;
use App\Http\Controllers\web\SkillController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\web\ContactController;
use App\Http\Controllers\web\ProfileController;
use App\Http\Controllers\web\CategoryController;
use App\Http\Controllers\Admin\MessageController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\ExamController as AdminExamController;
use App\Http\Controllers\Admin\ExamQuestions;
use App\Http\Controllers\Admin\HomeController as AdminHomeController;
use App\Http\Controllers\Admin\SkillController as AdminSkillController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware('lang')->group(function(){
    Route::get('/', [HomeController::class,'redirect']);
    Route::get('/home', [HomeController::class,'index']);
    Route::get('category/show/{id}', [CategoryController::class,'show']);
    Route::get('skill/show/{id}', [SkillController::class,'show']);
    Route::get('questions/show/{id}', [ExamController::class,'questions']);
    Route::post('contact/send/message',[ContactController::class,"send"]);
    Route::middleware(['auth','verified','student'])->group(function(){
        Route::get('/contact',[ContactController::class,"index"]);
        Route::get('exam/show/{id}', [ExamController::class,'show']);
        Route::get('/profile',[ProfileController::class,'index']);
    });
});

Route::middleware(['auth','verified','student'])->group(function(){
    Route::post('exam/enter/{id}', [ExamController::class,'startExam']);
    Route::post('exam/submit/{id}', [ExamController::class,'submitExam']);
    Route::get('/profile',[ProfileController::class,'index']);
});

// language routes
Route::get('lang/set/{lang}', [LangController::class,'langs']);
Route::get('lang/set/{lang}', [LangController::class,'langs']);

// ,'middleware'=>['auth','verified','can-enter-dashboard']
// admin routes
Route::group(['prefix'=>'dashboard'],function(){
    Route::get('/home',[AdminHomeController::class,'index']);
    // Route::get('/home',[HomeController::class,'index']);
    Route::get('/categories',[CatController::class,'index']);
    Route::post('/categories/store',[CatController::class,'store']);
    Route::post('/categories/update',[CatController::class,'update']);
    Route::delete('/categories/delete/{cat}',[CatController::class,'destroy']);
    //////////////////////////////skills
    Route::get('/skills',[AdminSkillController::class,'index']);
    Route::post('/skills/store',[AdminSkillController::class,'store']);
    Route::get('/skills/edit',[AdminSkillController::class,'edit']);
    Route::post('/skills/update',[AdminSkillController::class,'update']);
    Route::delete('/skills/delete',[AdminSkillController::class,'destroy']);
    ////////////////////////////////exams
    Route::get('/exams',[AdminExamController::class,'index'])->name('exam.index');
    Route::get('/exams/create',[AdminExamController::class,'create'])->name('exam.create');
    Route::post('/exams/store',[AdminExamController::class,'store'])->name('exam.store');
    Route::get('/exams/show/{exam}',[AdminExamController::class,'show'])->name('exam.show');
    Route::get('/exams/edit/{exam}',[AdminExamController::class,'edit'])->name('exam.edit');
    Route::put('/exams/update/{exam}',[AdminExamController::class,'update'])->name('exam.update');
    Route::delete('/exams/delete',[AdminExamController::class,'destroy'])->name('exam.destroy');

    //////////////////////////////questions
    Route::get('/exam/create-questions/{exam}',[ExamQuestions::class,'create'])->name('exam-questions.create');
    Route::post('/exam/store-questions/{exam}',[ExamQuestions::class,'store'])->name('exam-questions.store');
    Route::get('/exams/show-questions/{exam}/questions',[ExamQuestions::class,'show'])->name('exam-questions.show');
    Route::get('/exams/edit-questions/{exam}/{question}',[ExamQuestions::class,'edit'])->name('exam-questions.edit');
    Route::put('/exam/update-questions/{exam}/{question}',[ExamQuestions::class,'update'])->name('exam-questions.update');
    // Route::resource('exam-questions',ExamQuestions::class)->except('destroy');

    ///////////////////////////students
    Route::get('students',[StudentController::class,'index']);
    Route::get('students/show-scores/{studentId}',[StudentController::class,'show']);
    Route::get('students/open-exam/{studentId}/{examId}',[StudentController::class,'openExam']);
    Route::get('students/close-exam/{studentId}/{examId}',[StudentController::class,'closeExam']);
    //////////////////////Admins
    Route::middleware('superadmin')->group(function(){
        Route::get('/admins',[AdminController::class,'index']);
        Route::get('/admins/create-new-admin',[AdminController::class,'create']);
        Route::post('/admins/store-admin',[AdminController::class,'store']);
        Route::post('/admins/promote/{id}',[AdminController::class,'promote']);
        Route::post('/admins/demote/{id}',[AdminController::class,'demote']);
        Route::post('/admins/delete/{id}',[AdminController::class,'delete']);
    });
        ///////////////////Messages
        Route::get('/messages',[MessageController::class,'index']);
        Route::get('/messages/show-message/{message}',[MessageController::class,'show']);
        Route::post('/messages/response/{message}',[MessageController::class,'response']);
});



// Route::get('/', function () {
//     Toastr::success('Messages in here');
//     return view('web.home.index');
// });
