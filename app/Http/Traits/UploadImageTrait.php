<?php

namespace App\Http\Traits;

use Illuminate\Support\Facades\File;

trait UploadImageTrait{

    public function uploadImage($name,$folder)
    {
        
       $imageExtension=$name->getClientOriginalExtension();
       $imageUploadName=time(). uniqid() . '.' . $imageExtension;
       $path=public_path($folder);
       $name->move($path,$imageUploadName);
       return $imageUploadName;
    }

    public function deleteImage($imagePath)
    {
        if(File::exists($imagePath)){
            File::delete($imagePath);
        }
    }
}
