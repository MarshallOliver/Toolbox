<?php

namespace App\CenterEdge;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    protected $table = 'Areas';
    protected $primaryKey = 'AreaGUID';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timesteps = false;

    public function arrivals() {
    	return $this->belongsToMany('\App\CenterEdge\Arrival', 'GroupAreaBookings', 'AreaGUID', 'RefID');
    }
}
