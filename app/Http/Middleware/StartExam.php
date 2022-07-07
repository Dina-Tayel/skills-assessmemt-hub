<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StartExam
{

    public function handle(Request $request, Closure $next)
    {
        $examId = $request->route()->parameter('examId');
        $user=Auth::user();
        $pivotRow=$user->exams()->where("exam_id",$examId)->first();
        if($pivotRow !== null  && $pivotRow->pivot->status== "closed")
        {
             return response()->json(['You Entered Exam before !']);
        }
         return $next($request);
    }
}
