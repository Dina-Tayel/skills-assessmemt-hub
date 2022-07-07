<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\SkillResource;
use App\Models\Skill;
use Illuminate\Http\Request;

class SkillController extends Controller
{
    public function index()
    {
        $skills=Skill::get();
        return SkillResource::collection($skills);
    }
    public function show(Skill $skill)
    {
        // $skill=Skill::with(['category','exams'])->findOrFail($id);
        $skill=$skill->load(['category','exams']);
        return new SkillResource($skill);

    }
}
