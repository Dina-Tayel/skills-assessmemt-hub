<?php

use App\Http\Controllers\web\CategoryController;
use App\Http\Controllers\web\ContactController;
use App\Http\Controllers\web\ExamController;
use App\Http\Controllers\web\HomeController;
use App\Http\Controllers\web\LangController;
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
    Route::get('/', [HomeController::class,'index']);
    Route::get('category/show/{id}', [CategoryController::class,'show']);
    Route::get('skill/show/{id}', [SkillController::class,'show']);
    Route::get('exam/show/{id}', [ExamController::class,'show']);
    Route::get('questions/show/{id}', [ExamController::class,'questions']);
    Route::get('/contact',[ContactController::class,"index"]);
    Route::post('contact/send/message',[ContactController::class,"send"]);
});

// language routes
Route::get('lang/set/{lang}', [LangController::class,'langs']);
Route::get('lang/set/{lang}', [LangController::class,'langs']);

