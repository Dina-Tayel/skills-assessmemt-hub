<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\App;

class ExamResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {

        return [
            'name'=>$this->name(App::getLocale()),
            'desc'=>substr($this->desc(App::getLocale()),0,50),
            'img'=>asset('uploads/exams/'.$this->img),
            'questions_no'=>$this->questions_no,
            'duration_mins'=>$this->duration_mins,
            'difficulty'=>$this->difficulty,
            'questions'=>QuestionResource::collection($this->whenLoaded('questions')),
        ];
    }
}
