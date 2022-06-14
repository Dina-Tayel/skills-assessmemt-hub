<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class Category extends Model
{
    use HasFactory;

    //fillable fileds
    protected $guarded=['id','created_at','updated_at'];


    // relationship

    //category has many skills
    public function skills()
    {
        return $this->hasMany(Skill::class,'category_id');
    }

    //decode name according to websitelanguage
    public function name($lang=null)
    {

        // if(App::getLocale()=='en')
        // {
        //     return json_decode($this->name()=='en');
        // }
        // return json_decode($this->name()=='ar');

        //use open close principle
        $lang= $lang ?? App::getLocale();
        return json_decode($this->name)->$lang;
    }

    // use local scope
    public function scopeActive($query) // camelcase
    {
        return $query->where('active',1);
    }
    
}
