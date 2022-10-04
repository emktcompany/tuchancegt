<?php

namespace App\Http\Resources;

class LaborMobilityCountryResource extends BaseResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'         => $this->id,
            'name'       => $this->name,
            'remote_id'  => $this->remote_id,
            'created_at' => $this->asDate('created_at'),
        ];
    }
}
