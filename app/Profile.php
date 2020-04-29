<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    public function actions(){
        return $this->hasMany('App\Action','user_id','user_id');
    }
}
