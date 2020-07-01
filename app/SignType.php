<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SignType extends Model
{

    public function signs() {
    	$this->hasMany('App\Sign');
    }

}
