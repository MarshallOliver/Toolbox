<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SignArea extends Model
{

	protected $fillable = [
		'sign_id', 'area_guid',

	];

    public function sign() {
    	return $this->belongsTo('sign');
    }

    public function name() {
    	
    	$name = DB::connection($this->sign->database_id)->table('Areas')->select('Description')->where('Area_GUID', $this->area_guid)->get();

    	dd($name);

    	return $name->Description;

    }

}
