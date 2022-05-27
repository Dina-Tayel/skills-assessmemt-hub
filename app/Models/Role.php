<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    //fillable fileds
    protected $guarded=['id','created_at','updated_at'];

    // relationship

    // one role has many users
    public function users()
    {
        return $this->hasMany(User::class);
    }
    
}
