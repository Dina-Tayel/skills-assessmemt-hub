<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SkillRequest;
use App\Http\Requests\UpdateSkillRequest;
use App\Http\Traits\UploadImageTrait;
// use App\Models\Category;
// use App\Models\Skill;
use Illuminate\Http\Request;
use App\Models\{Category,Skill};

class SkillController extends Controller
{
    use UploadImageTrait;
    public function index()
    {
        $data['skills']=Skill::paginate(10);
        $data['cats']=Category::select('id','name')->get();
        return view("admin.skills.index")->with($data);
    }

    public function store(SkillRequest $request)
    { 

        $newImg=$this->uploadImage($request->file('img'),'uploads/skills/');
        $skill=Skill::create([
            'name'=>json_encode(['en'=>$request->name_en,'ar'=>$request->name_ar]),
            'img'=>$newImg,
            'category_id'=>$request->category_id,
        ]);
        $data['skill']=$skill;
        return view('admin.skills.row')->with($data);

    }

    public function edit(Request $request)
    {
        $id=$request->id;
        $data=Skill::findOrFail($id);
        
        return response()->json($data);
    }
    
    public function update(UpdateSkillRequest $request)
    {

        $skill=Skill::findOrFail($request->id);
        if(!empty($request->img)){
            $imageUploadName= $this->uploadImage($request->img,"uploads/skills");
            $this->deleteImage("uploads/skills/$skill->img");
              $skill->update([
                'img'=>$imageUploadName,
                "name"=>json_encode([
                'en'=>$request->name_en,
                'ar'=>$request->name_ar, ])
                  ] + $request->validated());
        }
        $skill->update([
            'img'=>$skill->img,
            "name"=>json_encode([
            'en'=>$request->name_en,
            'ar'=>$request->name_ar, ])
              ] + $request->validated());

       $request->session()->flash('success','row is updated sccessfully');
        return back();
        //json
        // $respose['skill']=$skill;
        // $respose['skill']=$request->id;
        // return response()->json($respose);
        // return view("admin.cats.rowEdit")->with($respose);
    }

    public function destroy(Request $request)
    {
        $id=$request->id;
        $skill=Skill::findOrFail($id);
        // if(!$skill){
        //     return response()->json(['success'=>'skill is not found']);
        // }
        $skill->delete();
        $this->deleteImage("uploads/skills/$skill->img");
        return response()->json(['id'=>$id,'success'=>'skill deleted successfully']);
    }
}
