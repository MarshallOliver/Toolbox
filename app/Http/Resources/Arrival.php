<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

class Arrival extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

        $table = \App\CenterEdge\Arrival::fieldMap['table'];
        $fieldMap = \App\CenterEdge\Arrival::fieldMap['fields'];
        $base64 = \App\CenterEdge\Arrival::base64;

        $result = [];

        if ($request->fields) {
            $selects = Str::of($request->fields)->explode(',');
        } else {
            $selects = array_keys($fieldMap);
        }

        foreach ($selects as $select) {

            if (!array_key_exists($select, $fieldMap)) { continue; }

            $this->addSelect($table . '.' . $fieldMap[$select]);
            if (in_array($select, $base64)) {
                $result[$select] = base64_encode($this->{$fieldMap[$select]});
            } else {
                $result[$select] = $this->{$fieldMap[$select]};
            }

        }

        $result['areas'] = new AreaCollection($this->whenLoaded('areas'));

        $result['group_area_bookings'] = new GroupAreaBookingCollection($this->whenLoaded('bookings'));

        return $result;
    }
}