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

        $fieldMap = \App\CenterEdge\Arrival::fieldMap;
        $base64 = \App\CenterEdge\Arrival::base64;

        $result = [];

        if ($request->fields) {
            $selects = Str::of($request->fields)->explode(',');
        } else {
            $selects = array_keys($fieldMap);
        }

        foreach ($selects as $select) {

            if (!array_key_exists($select, $fieldMap)) { continue; }

            $this->addSelect($fieldMap[$select]);
            if (in_array($select, $base64)) {
                $result[$select] = base64_encode($this->{$fieldMap[$select]});
            } else {
                $result[$select] = $this->{$fieldMap[$select]};
            }

        }

        $result['areas'] = new AreaCollection($this->whenLoaded('areas'));

        $result['booking_details'] = $this->whenPivotLoaded('GroupAreaBookings', function () {
            return [
                'event_date' => $this->pivot->EventDate,
                'start_date_time' => $this->pivot->StartDateTime,
                'end_date_time' => $this->pivot->EndDateTime,

            ];
        });

        return $result;
    }
}