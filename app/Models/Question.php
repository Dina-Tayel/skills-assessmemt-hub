<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

     //fillable fileds
     protected $guarded=['id','created_at','updated_at'];


    //relationship

    // question belongs to exam 

    public function exam()
    {
        return $this->belongsTo(Exam::class,'exam_id');
    }

}
