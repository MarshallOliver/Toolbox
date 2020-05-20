<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Signage extends Model
{

	protected $table = 'signage';

	protected $fillable = ['name',
							'details',
							'database_id'
						];

    public function database()
    {
    	return $this->belongsTo('App\Database');
    }

    public function location()
    {
    	return $this->hasOneThrough('App\Location', 'App\Database', 'id', 'id', 'database_id', 'location_id');
    }
}
