<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CatRequset;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use App\Models\Skill;
use Exception;
use Illuminate\Http\Request;

class CatController extends Controller
{
    public function index()
    {
          $data['cats']=Category::orderBy('id','ASC')->paginate(10);
          return view("admin.cats.index")->with($data);
    }
    public function store(CatRequset $request)
    {
     // dd($request->all());
      $data= Category::create([
        "name"=>json_encode(['en'=>$request->name_en , 'ar'=>$request->name_ar]),
       ]);
       $response['cat']=$data;
       $respose['id']=$request->id;
       return view("admin.cats.row")->with($response);
        // return redirect()->back();
    }

    public function update(UpdateCategoryRequest $request)
    {
      $cat=Category::findOrFail($request->id);
      $cat->update([
        "name"=>json_encode([
          'en'=>$request->name_en,
          'ar'=>$request->name_ar,
        ]),
      ]);

      // return  back();
      $respose['cat']=$cat;
      $respose['id']=$request->id;
      return view("admin.cats.rowEdit")->with($respose);
    }

    public function destroy(Category $cat)
    {
    //  try{
    //   $cat->delete();
    //   $msg='category is deleted successfully';
    //  }catch( Exception $e)
    //  {
    //   $msg='cant delete this row';
    //  }
     
      $id=$cat->id;
      $cat=Category::findOrFail($id);
      $cat->delete();
      $msg='category is deleted successfully';
      return response()->json(['success'=>$msg,'id'=>$id]);
    }
}
