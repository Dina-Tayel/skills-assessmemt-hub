<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $pageSize=$request->page_size ?? PAGINATION_COUNT ;
        $cats=Category::paginate($pageSize);
        return CategoryResource::collection($cats);
    }

    public function show(Category $category)
    {
        $category=$category->load('skills');
        return new CategoryResource($category);
    }
}
