<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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

    public function rules()
    {
        return [
            "name"     => "required|max:255|min:6",
            "email"    => "required|email|unique:messages,email",
            "subject"  => "nullable|max:200",
            "body"      => "required",
        ];
    }

    public function messages()
    {
        return [
            'name.required' =>  __('messages.MessageNameRequired'),
            'name.min'=>__('messages.MessageNameMin'),
            'name.max'=>__('messages.MessageNameMax'),
            'email.required' =>__('messages.MessageEmailRequired'),
            'email.email'=>__('messages.MessageEmailEmail'),
            'email.unique'=>__('messages.MessageEmailUnique'),
            'subject.max'=>__('messages.MessageSubjectString'),
            'body.required'=>__('messages.MessageBodyRequired'),
        ];
    }

    // public function messages()
    // {
        // return [
        //     'name.required' => ':attribute is required',
        //     'email.required' => ':attribute is required',
        //     'body.required'=>    ':attribute is required',
        // ];
    // }

    // public function attributes()
    // {
    //     return [
    //         'name' => 'name',
    //         'email' => 'Email',
    //         'body' => 'Message',
    //     ];
    // }


}
