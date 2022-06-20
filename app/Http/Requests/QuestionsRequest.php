<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class QuestionsRequest extends FormRequest
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
            'title'=>'required|array',
            'title.*'=>'required|string|max:600',
            'right_ans'=>'required|array',
            'right_ans.*'=>'required|integer|in:1,2,3,4',
            'option_1'=>'required|max:255',
            'option_1.*'=>'required|string|max:255',
            'option_2'=>'required|max:255',
            'option_2.*'=>'required|string|max:255',
            'option_3'=>'required|max:255',
            'option_3.*'=>'required|string|max:255',
            'option_4'=>'required|max:255',
            'option_4.*'=>'required|string|max:255',
        ];
    }

    public function messages()
    {
        return[
            'title.*.required' => 'You must have an item title.',
            'right_ans.*.required' => 'You must have an item right answer.',
            'option_1.*.required' => 'You must have an item option 1.',
            'option_2.*.required' => 'You must have an item option 2.',
            'option_3.*.required' => 'You must have an item option 3.',
            'option_4.*.required' => 'You must have an item option 4.',
            'title.*.string' => 'title must be string.',
            'option_1.*.string' => 'title must be string.',
            'option_2.*.string' => 'title must be string.',
            'option_3.*.string' => 'title must be string.',
            'option_4.*.string' => 'title must be string.',
            'option_1.*.integer' => 'You have invalid characters in the price field.',
            'right_ans.*.in' => 'The selected right answer is invalid.',
            'title.*.max' => 'The item name must not surpass 500 characters.',
            'option_1.*.max' => 'The item name must not surpass 255 characters.',
            'option_2.*.max' => 'The item name must not surpass 255 characters.',
            'option_3.*.max' => 'The item name must not surpass 255 characters.',
            'option_4.*.max' => 'The item name must not surpass 255 characters.',

        ];
    }
}
