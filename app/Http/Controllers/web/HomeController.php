<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{

    public function index()
    {
        $cats=Category::select('id', 'name')->get(); 
        $user=Auth::user();
        if(!$user)
        {
            return view("web.home.index",compact("cats"));   
        }
        if($user->role->name == "student")
        {
            return view("web.home.index",compact("cats"));
        } else{

            return redirect(url('dashboard/home'));     
        }
    }

    public function redirect()
    {
        $cats=Category::select('id', 'name')->get();
        return view("web.home.index",compact("cats")); 
    }

}