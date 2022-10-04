<?php

namespace App\Http\Resources;

class LaborMobilityEstateResource extends BaseResource
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
            'id'                        => $this->id,
            'name'                      => $this->name,
            'state'                     => $this->state,
            'province'                  => $this->province,
            'city'                      => $this->city,
            'county'                    => $this->county,
            'labor_mobility_country_id' => $this->labor_mobility_country_id,
            'country_id'                => $this->country_id,
            'city_id'                   => $this->city_id,
            'state_id'                  => $this->state_id,
            'created_at'                => $this->asDate('created_at'),
            'country'                   => new LaborMobilityCountryResource($this->whenLoaded('country')),
        ];
    }
}
