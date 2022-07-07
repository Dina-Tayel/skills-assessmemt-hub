<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ExamController;
use App\Http\Controllers\Api\ExamQuestionsController;
use App\Http\Controllers\Api\SkillController as ApiSkillController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

define('PAGINATION_COUNT',10);
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('register',[AuthController::class,'register']);
Route::post('login',[AuthController::class,'login']);
Route::post('logout',[AuthController::class,'logout'])->middleware('auth::sanctum');
Route::middleware(['auth:sanctum','check.lang'])->group(function(){
    Route::post('categories',[CategoryController::class,'index']);
    Route::post('categories/show-category/{category}',[CategoryController::class,'show']);
    Route::post('skills',[ApiSkillController::class,'index']);
    Route::post('skills/show-skill/{skill}',[ApiSkillController::class,'show']);
    Route::post('exams/show-exam/{exam}',[ExamController::class,'show']);
    Route::post('exams/show-questions/{exam}',[ExamQuestionsController::class,'show']);
    Route::post('exams/start-exam/{examId}',[ExamController::class,'start'])->middleware('start.exam');
    Route::post('exams/submit/{examId}',[ExamController::class,'submit'])->middleware('submit.exam');
});




