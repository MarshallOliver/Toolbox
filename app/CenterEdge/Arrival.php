<?php

namespace App\CenterEdge;

use Illuminate\Database\Eloquent\Model;

class Arrival extends Model
{
    protected $table = 'GroupArrivals';
    protected $primaryKey = 'RefID';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timesteps = false;

    protected $hidden = ['SecurityCode'];

    public function areas() {
    	return $this->belongsToMany('\App\CenterEdge\Area', 'GroupAreaBookings', 'RefID', 'AreaGUID')->withPivot('EventDate', 'StartDateTime', 'EndDateTime');
    }
}
