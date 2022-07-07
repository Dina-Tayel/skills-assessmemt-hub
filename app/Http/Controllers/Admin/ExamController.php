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
        $data['skills']=Skill::select('id', 'name')->get();
        return view('admin.exams.create')->with($data);
    }

    public function store(ExamRequset $request)
    {
       $uplaodedImage= $this->uploadImage($request->file('img'),'uploads/exams/');
       $exam= Exam::create(
       [
        'img'=>$uplaodedImage,
        'name'=>json_encode(['en'=>$request->name_en,'ar'=>$request->name_ar]),
        'desc'=>json_encode(['en'=>$request->desc_en,'ar'=>$request->desc_ar]),
        'active'=>0,
        ]+$request->validated());
        event(new ExamAddedEvent);
        $request->session()->flash('prev',"exam/create-questions/$exam->id");
        return redirect()->route("exam-questions.create",$exam->id);
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
        $uplaodedImage=$exam->img;
        if(!empty($request->img)){
            $uplaodedImage=$this->uploadImage($request->file('img'),"uploads/exams/");
            $this->deleteImage("uploads/exams/$exam->img");
        }
        $exam->update(
            [
                'name'=>json_encode(['en'=>$request->name_en , 'ar'=>$request->name_ar]),
                'desc'=>json_encode(['en'=>$request->desc_en , 'ar'=>$request->desc_ar]),
                'img'=>$uplaodedImage,
            ] + $request->validated() );
        return redirect()->route("exam.show",$exam->id);
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

}
