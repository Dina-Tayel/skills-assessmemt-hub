<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\QuestionsRequest;
use App\Http\Requests\updateQuestionRequest;
use App\Models\Exam;
use App\Models\Question;
use Illuminate\Http\Request;

class ExamQuestions extends Controller
{

    public function create(Exam $exam)
    {
        // if(session('prev')!== "exam/create-questions/$exam->id" and session('current')!== "exam/questions/$exam->id"  ){
        //     return redirect('dashboard/home');
        // }
        $data['examId']=$exam->id;
        $data['questions_no']=$exam->questions_no;
        return view('admin.exam-questions.create')->with($data);
    }

    public function store(QuestionsRequest $request ,Exam $exam)
    {
        $request->session()->flash('current',"exam/questions/$exam->id");
        for($i=0 ; $i < $exam->questions_no ; $i++){

            Question::create([
                'title'=>$request->title[$i],
                'option_1'=>$request->option_1[$i],
                'option_2'=>$request->option_2[$i],
                'option_3'=>$request->option_3[$i],
                'option_4'=>$request->option_4[$i],
                'right_ans'=>$request->right_ans[$i],
                'exam_id'=>$exam->id,
                'title'=>$request->title[$i],
               ]);
        }
        $exam->update(['active'=>1,]);
        return redirect()->route('exam.index');
    }

    public function show(Exam $exam)
    {
        $data['exam']=$exam;
        $data['questions']=$exam->questions;
        return view('admin.exam-questions.show')->with($data);
    }

    public function edit(Exam $exam,Question $question)
    {
        $data['examId']=$exam->id;
        $data['question']=$question;
        return view('admin.exam-questions.edit')->with($data);
    }

    public function update(Exam $exam , Question $question , updateQuestionRequest $request)
    {
        $question->update($request->validated());
        return  redirect()->route("exam-questions.show",$exam->id);
    }

}
