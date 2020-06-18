<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

class Area extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        
        $table = \App\CenterEdge\Area::fieldMap['table'];
        $fieldMap = \App\CenterEdge\Area::fieldMap['fields'];
        $base64 = \App\CenterEdge\Area::base64;

        $result = [];

        if ($request->fields) {
            $selects = Str::of($request->fields)->explode(',');
        } else {
            $selects = array_keys($fieldMap);
        }

        foreach ($selects as $select) {

            if (!array_key_exists($select, $fieldMap)) { continue; }

            $this->addSelect($table . '.' . $fieldMap[$select]);
            if (in_array($select, $base64) && $this->{$fieldMap[$select]}) {
                $result[$select] = base64_encode($this->{$fieldMap[$select]});
            } else {
                $result[$select] = $this->{$fieldMap[$select]};
            }

        }

        $result['arrivals'] = new ArrivalCollection($this->whenLoaded('arrivals'));

        $result['group_area_bookings'] = $this->whenPivotLoaded('GroupAreaBookings', function () {
            return [
                'event_date' => $this->pivot->EventDate,
                'start_date_time' => $this->pivot->StartDateTime,
                'end_date_time' => $this->pivot->EndDateTime,

            ];
        });

        return $result;
    }
}
