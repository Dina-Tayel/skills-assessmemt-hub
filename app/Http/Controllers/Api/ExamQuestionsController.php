<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ExamResource;
use App\Models\Exam;
use Illuminate\Http\Request;

class ExamQuestionsController extends Controller
{
    public function show(Exam $exam)
    {
        $exam=$exam->load('questions');
        return ExamResource::make($exam);
    }

}
