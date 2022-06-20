<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExamRequset extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name_en'=>'required|string|max:150',
            'name_ar'=>'required|string|max:150',
            'skill_id'=>'required|exists:skills,id',
            'img'=>'required|image|mimes:png,jpg,gif,jpeg|max:2048', 
            'desc_en'=>'required|string|max:250',
            'desc_ar'=>'required|string|max:250',
            'questions_no'=>'required|integer|min:1',
            'difficulty'=>'required|integer|min:1|max:5',
            'duration_mins'=>'required|integer|min:1',
            
        ];
    }
}
