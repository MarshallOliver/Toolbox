<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sign extends Model
{

    public function database() {
    	return $this->belongsTo('App\Database');
    }

    public function signType() {
    	return $this->belongsTo('App\SignType');
    }

    public function signArea() {
    	return $this->hasOne('App\SignArea');
    }
}
