<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MessageRequest;
use App\Mail\ContactResponseMail;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MessageController extends Controller
{

    public function index()
    {
        $data['messages']=Message::orderBy('id','DESC')->paginate(10);
        return view('admin.messages.index')->with($data);
    }

    public function show(Message $message)
    {
        $data['message']=$message;
        return view('admin.messages.show-message')->with($data);
    }

    public function response(Message $message , MessageRequest $request)
    {
        $recieverMail=$message->email;
        Mail::to($recieverMail)->send(new ContactResponseMail($request->title,$request->body));
        return redirect('dashboard/messages');
    }

}
