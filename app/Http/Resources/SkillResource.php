<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\App;

class SkillResource extends JsonResource
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
            'img'=>asset('uploads/skills/'.$this->img),
            'category'=>new CategoryResource($this->whenLoaded('category')),
            'exam'=>ExamResource::collection($this->whenLoaded('exams')),
        ];
    }
}
