<?php

namespace App\Http\Controllers\web;

use App\Models\Message;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Requests\ContactRequest;


class ContactController extends Controller
{
    public function index()
    {
        $data['settings']=Setting::select('email','phone')->first();
        // return($data['settings']->email);
        return view("web.contact.index")->with($data);
    }
    public function send(ContactRequest $request)
    {
        if($request->ajax())
        {
            Message::create($request->validated());
            $data=["success"=>'Your Message is sent Successfully'];
            return response()->json($data);
        }
    }
}
