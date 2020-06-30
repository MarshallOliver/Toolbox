<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Database extends Model
{
	protected $fillable = [
		'host',
		'port',
		'catalog',
		'username',
		'password',

	];

    public function location() {
    	return $this->belongsTo('App\Location');
    }

    public function getPasswordAttribute($value)
    {
    	return decrypt($value);
    }

    public function setPasswordAttribute($value)
    {
    	$this->attributes['password'] = encrypt($value);
    }
}
