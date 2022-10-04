<?php

namespace App\Http\Resources;

class LaborMobilityReturnResource extends BaseResource
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
            'state'                     => $this->state,
            'province'                  => $this->province,
            'city'                      => $this->city,
            'county'                    => $this->county,
            'contract_init'             => $this->asDate('contract_init'),
            'contract_end'              => $this->asDate('contract_end'),
            'position'                  => $this->position,
            'contract_type'             => $this->contract_type,
            'contract_number'           => $this->contract_number,
            'weekly_hours'              => $this->weekly_hours,
            'day_wage'                  => $this->day_wage,
            'is_farming'                => $this->is_farming,
            'labor_mobility_country_id' => $this->labor_mobility_country_id,
            'labor_mobility_estate_id'  => $this->labor_mobility_estate_id,
            'labor_mobility_person_id'  => $this->labor_mobility_person_id,
            'created_at'                => $this->asDate('created_at'),

            'country' => new LaborMobilityCountryResource($this->whenLoaded('country')),
            'person' => new LaborMobilityPersonResource($this->whenLoaded('person')),
            'estate' => new LaborMobilityEstateResource($this->whenLoaded('estate')),
        ];
    }
}
