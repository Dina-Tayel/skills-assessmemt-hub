<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Skill;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function show($id)
    {
        $data["cat"]=Category::findOrFail($id);
        $data["allCats"]=Category::select("id","name")->get();
        $data["skills"]=$data["cat"]->skills()->paginate(6);
        // using model binding
        // $allCats=Category::select("id","name")->get();
        // $skills=$category->load(['skills'=>function($query){
        //     $query->paginate(6);
        // }]);
        //     dd($skills->id);
         
        return view('web.categories.show')->with($data);
    }
    
}
