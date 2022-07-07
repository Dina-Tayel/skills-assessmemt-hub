<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class Exam extends Model
{
    use HasFactory;

     //fillable fileds
     protected $guarded=['id','created_at','updated_at'];

    //relationship

    //exam belongs to skill
    public function skill()
    {
        return $this->belongsTo(Skill::class,'skill_id');
    }

    //exam has many questions
    public function questions()
    {
        return $this->hasMany(Question::class,'exam_id');
    }

    //exam belongs to many users
    public function users()
    {
        return $this->belongsToMany(User::class)
        ->withPivot('score','max_time','status')->withTimestamps();
    }

    // decode name according to websitelanguage
    public function name($lang=null)
    {
        $lang = $lang ?? App::getLocale();
        return json_decode($this->name)->$lang;
    }

    // decode description according to websitelanguage
    public function desc($lang = null)
    {
        $lang = $lang ?? App::getLocale();
        return json_decode($this->desc)->$lang;
    }

    // use local scope
    public function scopeActive($query) // camelcase
    {
        return $query->where('active',1);
    }




}
