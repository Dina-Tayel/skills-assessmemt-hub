<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController;
use App\Http\Resources\ExamResource;
use App\Models\Exam;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ExamController extends BaseController
{
    public function show(Exam $exam)
    {
         return ExamResource::make($exam);
    }


    public function showQuestions(Exam $exam)
    {
        $exam=$exam->load('questions');
        return ExamResource::make($exam);
    }

    public function start(Request $request , $examId)
    {
        if(! $request->user()->exams->contains($examId))
        {
            $request->user()->exams()->attach($examId);
        }
        else{
            $request->user()->exams()->updateExistingPivot($examId,['status'=>'closed']);
        }
       return $this->sendResponse('you are started the exam');
    }

    public function calculateScore($examId,$request)
    {
        $exam=Exam::findOrFail($examId);
        $totlQuestions=count($exam->questions);
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
        $score=($points / $totlQuestions)*100;
       return $score;
    }

    public function calculateDiffMins($submitTime,$startTime)
    {
         return $submitTime->diffInMinutes($startTime);
    }

    public function submit($examId , Request $request)
    {
        $validator=Validator::make($request->all(),[
            'answers'=>'required|array',
            'answers.*'=>'required|in:1,2,3,4'
        ]);
        if($validator->fails())
        {
            return response()->json(['error'=>$validator->errors()]);
        }
        $exam=Exam::findOrFail($examId);
        $score=$this->calculateScore($examId,$request);
       // calculate time
        $user=$request->user();
        $pivotRow=$user->exams()->where('exam_id',$examId)->first();
        if($pivotRow)
        {
        $startTime=$pivotRow->pivot->created_at;
        $diffMins= $this->calculateDiffMins(Carbon::now(),$startTime);
        $score = 0 ? $diffMins > $exam->duration_mins : $score ;
        //update pivot row
        $user->exams()->updateExistingPivot($examId,[
            'score'=>$score,
            'max_time'=>$diffMins,
            'status'=>'closed',
        ]);
        return $this->sendResponse("You Submitted Exam Successfullt with score $score %");

        }else{
            return $this->sendResponse(['Please Enter Exam first !']);
        }

    }
}
