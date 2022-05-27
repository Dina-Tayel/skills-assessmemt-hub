<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LangController extends Controller
{
    public function langs($lang , Request $request)
    {
       $acceptedLangs=['ar','en'];
       if(! in_array($lang,$acceptedLangs))
       {
           $lang='en';
       } 
       $request->session()->put('lang',$lang);
       return back();
    }
}
