<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class test_information extends Model
{
    use SoftDeletes;

    public function user()
    {
        return $this->hasOne('App\User');
    }
}