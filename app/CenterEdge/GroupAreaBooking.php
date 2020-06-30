<?php

namespace App\CenterEdge;

use Illuminate\Database\Eloquent\Model;

class GroupAreaBooking extends Model
{
    protected $table = 'GroupAreaBookings';
    protected $primaryKey = null;
    public $incrementing = false;
    public $timestamps = false;

    const fieldMap = [
    	'table' => 'GroupAreaBookings',
    	'fields' => [
    		'ref_id' => 'RefID',
    		'area_guid' => 'AreaGUID',
    		'sub_area_guid' => 'SubAreaGUID',
    		'slot_guid' => 'SlotGUID',
    		'event_date' => 'EventDate',
    		'start_date_time' => 'StartDateTime',
    		'end_date_time' => 'EndDateTime',
    		'quantity' => 'Quantity',
    		'actual_quantity' => 'ActQuantity',

    	]
    ];

    const base64 = [];

    public function area() {
    	return $this->belongsTo('App\CenterEdge\Area', 'AreaGUID', 'AreaGUID');
    }

    public function arrival() {
    	return $this->belongsTo('App\CenterEdge\Arrival', 'RefID', 'RefID');
    }
}
