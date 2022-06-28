<?php

namespace App\Http\Controllers\Admin;

use App\Events\ExamAddedEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\ExamRequset;
use App\Http\Requests\QuestionsRequest;
use App\Http\Requests\updateExamRequest;
use App\Http\Requests\updateQuestionRequest;
use App\Http\Traits\UploadImageTrait;
use App\Models\Exam;
use App\Models\Question;
use App\Models\Skill;
use Illuminate\Http\Request;

class ExamController extends Controller
{
    use UploadImageTrait;

    public function index()
    {
        $data['exams']=Exam::select('id','name','skill_id','active','questions_no','img')->orderBy('id','DESC')-> paginate(10);
        return view('admin.exams.index')->with($data);
    }

    public function create()
    {
        $data['skills']=Skill::get();
        return view('admin.exams.create')->with($data);
    }



    public function store(ExamRequset $request)
    {
        // dd($request);
       $uplaodedImage= $this->uploadImage($request->file('img'),'uploads/exams/');
       $exam= Exam::create(
       [
        'img'=>$uplaodedImage,
        'name'=>json_encode(['en'=>$request->name_en,'ar'=>$request->name_ar]),
        'desc'=>json_encode(['en'=>$request->desc_en,'ar'=>$request->desc_ar]),
        'active'=>0,
        ]+$request->validated());
        event(new ExamAddedEvent) ;
        $request->session()->flash('prev',"exam/create-questions/$exam->id");
        return redirect(url("dashboard/exam/create-questions/$exam->id"));

    }

    public function show(Exam $exam)
    {
       
        $data['exam']=$exam;
        return view('admin.exams.show')->with($data);
    }

    public function edit(Exam $exam)
    {
        $data['exam']=$exam;
        $data['skills']=Skill::select('id','name')->get();
        return view('admin.exams.edit')->with($data);
    }

    public function update(Exam $exam , updateExamRequest $request)
    {
        if(!empty($request->img)){
            $uplaodedImage=$this->uploadImage($request->file('img'),"uploads/exams/");
            $this->deleteImage("uploads/exams/$exam->img");
            $exam->update(
            [
                'name'=>json_encode(['en'=>$request->name_en , 'ar'=>$request->name_ar]),
                'desc'=>json_encode(['en'=>$request->desc_en , 'ar'=>$request->desc_ar]),
                'img'=>$uplaodedImage,
            ] + $request->validated() );
            return redirect("dashboard/exams/show/$exam->id");
        }
        $exam->update(
                [
                    'name'=>json_encode(['en'=>$request->name_en , 'ar'=>$request->name_ar]),
                    'desc'=>json_encode(['en'=>$request->desc_en , 'ar'=>$request->desc_ar]),
                    'img'=>$exam->img,
                    'skill_id'=>$request->skill_id,
                    'difficulty'=>$request->difficulty,
                    'duration_mins'=>$request->duration_mins,
                    'questions_no'=>$request->questions_no,
                ]  );
            return redirect("dashboard/exams/show/$exam->id");
    }

    public function destroy(Request $request)
    {
        $id=$request->id;
        if($request->json())
        {
        $exam=Exam::findOrFail($id);
        $exam->delete();
        $this->deleteImage('uploads/exams/'.$exam->img);
        $data['id']=$id;
        $data['success']='exam is deleted successfully';
        return response()->json($data);
        }
    }

    public function createQuestions(Exam $exam , Request $request)
    {
        
        // if(session('prev')!== "exam/create-questions/$exam->id" and session('current')!== "exam/questions/$exam->id"  ){
        //     return redirect('dashboard/home');
        // }
        $data['examId']=$exam->id;
        $data['questions_no']=$exam->questions_no;
        return view('admin.exams.create-questions')->with($data);
       
       
    }

    public function storeQuestions(QuestionsRequest $request,Exam $exam)
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
        
        $exam->update([
            'active'=>1,
           ]);

           return redirect('dashboard/exams');
    }



    public function showQusetions(Exam $exam)
    {
        $data['exam']=$exam;
        $data['questions']=$exam->questions;
        return view('admin.exams.show-questions')->with($data);
    }

   public function editQuestions(Exam $exam,Question $question)
   {
    $data['examId']=$exam->id;
    $data['question']=$question;
    return view('admin.exams.edit-questions')->with($data);
   }

   public function updateQuestions(Exam $exam , Question $question , updateQuestionRequest $request)
   {
    $question->update($request->validated());
    return   redirect("dashboard/exams/show-questions/$exam->id/questions");

   }

}
