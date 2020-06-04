<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sign extends Model
{
    protected $fillable = [
    	'database_id', 'name', 'options',
    ];

    protected $casts = [
    	'options' => 'array',
    ];

    public function location() {
    	return $this->belongsTo('App\Location');
    }

    public function signType() {
    	return $this->belongsTo('App\SignType');
    }

    public function signArea() {
    	return $this->hasOne('App\SignArea');
    }
}
