<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class Skill extends Model
{
    use HasFactory;

    //fillable fileds
    protected $guarded=['id','created_at','updated_at'];


    // relationships

    // skill belongs to category
    public function category()
    {
        return $this->belongsTo(Category::class,'category_id');
    }

    // skill has many exams
    public function exams()
    {
        return $this->hasMany(Exam::class,'skill_id');
    }

    // decode name according to websitelanguage
    public function name($lang=null)
    {
    //   if(App::getLocale()=='en')
    //   {
    //       return json_decode($this->name)->en;
    //   }
    //   return json_decode($this->name)->ar;

    $lang=$lang ?? App::getLocale();
    return json_decode($this->name)->$lang;
    }

    // get all users that use the skill exam

    public function getStudenCount()
    {
        $studentNum=0;
        foreach($this->exams() as $exam)
        {
            $studentNum += $exam->users()->count();
        }
        return $studentNum;
    }

    // use local scope
    public function scopeActive($query) // camelcase
    {
        return $query->where('active',1);
    }
}
