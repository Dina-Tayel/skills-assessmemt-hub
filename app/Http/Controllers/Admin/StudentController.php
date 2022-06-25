<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        $studentRole=Role::where("name","student")->first();
        $data['students']=User::where('role_id',$studentRole->id)->paginate(10);
        // dd($data);
        return view('admin.students.index')->with($data);
    }

    public function show($studentId)
    {

        $student=User::findOrFail($studentId);
        if($student->role->name !== 'student')
        {
            return back();
        }
        $data['student']=$student;
        $data['exams']=$student->exams;
        // dd($data);
        return view('admin.students.show-scores')->with($data);
    }

    public function openExam($studentId,$examId)
    {
        $student=User::findOrFail($studentId);
        $student->exams()->updateExistingPivot($examId,['status'=>'opened']);
        return back();
    }

    public function closeExam($studentId,$examId)
    {
        $student=User::findOrFail($studentId);
        $student->exams()->updateExistingPivot($examId,['status'=>'closed']);
        return back();
    }
}
