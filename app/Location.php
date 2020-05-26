<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{

	protected $fillable = [
		'short_name',
		'long_name',
		'address1',
		'address2',
		'city',
		'state',
		'zip_code',

	];

    public function databases() {
    	return $this->hasMany('App\Database');
    }

}