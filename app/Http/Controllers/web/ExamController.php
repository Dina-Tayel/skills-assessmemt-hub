<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ExamController extends Controller
{
    public function show($examId)
    {
        $data["exam"]=Exam::findOrFail($examId);
        $user=Auth::user();
        $pivotRow=$user->exams()->where("exam_id",$examId)->first();
        $data['canEnterBtn']=true;
        if($user !== null)
        {
            if($pivotRow !== null && $pivotRow->pivot->status == "closed")
            {
                $data['canEnterBtn']= false;
            }
            
        }
        return view('web.exams.show')->with($data);
    }

    public function startExam($examId , Request $request)
    {
        $user=Auth::user();
        $user->exams()->attach($examId);
        $request->session()->flash('previousPage',"start/$examId");
        return redirect(url("questions/show/$examId"));
    }
    
    public function questions($examId , Request $request)
    {
        $data["exam"]=Exam::findOrFail($examId);
        // return  $data["exam"]->questions;
        if(session('previousPage') !== "start/$examId"){
            return redirect(url("exam/show/$examId"));
        }
        $request->session()->flash('previousPage',"questions/$examId");
        
        return view('web.exams.questions')->with($data);
    }


    public function submitExam($id, Request $request)
    {
        
        $request->validate([
            'answers'=>'required|array',
            'answers.*'=>['required|in:1,2,3'],
            ]);

            if(session('previousPage') !== "questions/$id"){
                return redirect(url("exam/show/$id"));
            }
            
            //calulate score
        $exam=Exam::findOrFail($id);
        // return $exam->duration_mins;
        $totlQuestions=count($exam->questions);
        // return $totlQuestions;
        $points=0;
        foreach ($exam->questions as $question)
        {
            if(isset($request->answers[$question->id]))
            {
                $userAnswer=$request->answers[$question->id];
                $rightAnswer=$question->right_ans;
                if($userAnswer==$rightAnswer)
                {
                    $points +=1;
                }
            
            }

        }
        // calulate score
        $score=($points / $totlQuestions)*100;
        $submitTime=Carbon::now();
        $user=Auth::user();
        $pivotRow=$user->exams()->where('exam_id',$id)->first();
        $startTime=$pivotRow->pivot->created_at;
        $diffMins=$submitTime->diffInMinutes($startTime);
        if($diffMins > $exam->duration_mins ){

            $score=0;
        }

        //update pivot row
        $user->exams()->updateExistingPivot($id,[
            'score'=>$score,
            'max_time'=>$diffMins,
        ]);
        $request->session()->flash('success',"You Are successfully Passed Exam With Score $score%");
        return redirect(url("exam/show/$id"));

    }
}
