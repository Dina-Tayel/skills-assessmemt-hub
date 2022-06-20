<?php

use App\Http\Controllers\Admin\CatController;
use App\Http\Controllers\Admin\ExamController as AdminExamController;
use App\Http\Controllers\Admin\HomeController as AdminHomeController;
use App\Http\Controllers\Admin\SkillController as AdminSkillController;
use App\Http\Controllers\web\CategoryController;
use App\Http\Controllers\web\ContactController;
use App\Http\Controllers\web\ExamController;
use App\Http\Controllers\web\HomeController;
use App\Http\Controllers\web\LangController;
use App\Http\Controllers\web\ProfileController;
use App\Http\Controllers\web\SkillController;
use Illuminate\Support\Facades\Route;

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
    Route::get('exam/show/{id}', [ExamController::class,'show']);
    Route::get('questions/show/{id}', [ExamController::class,'questions']);
    Route::get('/contact',[ContactController::class,"index"])->middleware(['auth','verified','student']);
    Route::post('contact/send/message',[ContactController::class,"send"]);
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
    Route::get('/exams',[AdminExamController::class,'index']);
    Route::get('/exams/create',[AdminExamController::class,'create']);
    Route::post('/exams/store',[AdminExamController::class,'store']);
    Route::get('/exams/show/{exam}',[AdminExamController::class,'show']);
    Route::get('/exams/edit/{exam}',[AdminExamController::class,'edit']);
    Route::put('/exams/update/{exam}',[AdminExamController::class,'update']);
    Route::delete('/exams/delete',[AdminExamController::class,'destroy']);
    ///////////////////////////////questions
    Route::get('/exam/create-questions/{exam}',[AdminExamController::class,'createQuestions']);
    Route::post('/exam/store-questions/{exam}',[AdminExamController::class,'storeQuestions']);
    Route::get('/exams/show-questions/{exam}/questions',[AdminExamController::class,'showQusetions']);
    Route::get('/exams/edit-questions/{exam}/{question}',[AdminExamController::class,'editQuestions']);
    Route::put('/exam/update-questions/{exam}/{question}',[AdminExamController::class,'updateQuestions']);
   
});