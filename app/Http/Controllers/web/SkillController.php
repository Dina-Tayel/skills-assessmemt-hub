<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Models\Skill;
use Illuminate\Http\Request;

class SkillController extends Controller
{
    public function show($id)
    {
        $data["skill"]=Skill::findOrFail($id);
        // foreach( $data["skill"]->exams as $exam){
        //     return $exam->users->count();
        // };
        return view('web.skills.show')->with($data);
    }
}
