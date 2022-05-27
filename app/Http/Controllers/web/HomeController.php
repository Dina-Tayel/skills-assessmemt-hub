<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $cats=Category::select('id', 'name')->get();        
        return view("web.home.index",compact("cats"));
    }
}