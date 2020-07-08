<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SignArea extends Model
{

	protected $fillable = [
		'sign_id', 'area_guid',

	];

    public function sign() {
    	return $this->belongsTo('App\Sign');
    }

}
