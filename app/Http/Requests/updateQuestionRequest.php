<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class updateQuestionRequest extends FormRequest
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
            'title'=>'required|string|max:600',
            'right_ans'=>'required|integer|in:1,2,3,4',
            'option_1'=>'required|string|max:255',
            'option_2'=>'required|string|max:255',
            'option_3'=>'required|string|max:255',
            'option_4'=>'required|string|max:255',
        ];
    }
}
