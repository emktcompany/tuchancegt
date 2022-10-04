<?php

namespace App\Http\Resources;

class TrainingPersonResource extends BaseResource
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
            'id'                 => $this->id,
            'full_name'          => $this->full_name,
            'first_name'         => $this->first_name,
            'middle_name'        => $this->middle_name,
            'last_name'          => $this->last_name,
            'sur_name'           => $this->sur_name,
            'place_of_birth'     => $this->place_of_birth,
            'age'                => $this->age,
            'gender'             => $this->gender,
            'ethnicity_id'       => $this->ethnicity_id,
            'id_number'          => $this->id_number,
            'cui_number'         => $this->cui_number,
            'address'            => $this->address,
            'state_id'           => $this->state_id,
            'city_id'            => $this->city_id,
            'phone'              => $this->phone,
            'phone_alt'          => $this->phone_alt,
            'email'              => $this->email,
            'language_community' => $this->language_community,
            'date_of_birth'      => $this->asDate('date_of_birth'),
            'created_at'         => $this->asDate('created_at'),
            'state'              => new StateResource($this->whenLoaded('state')),
            'city'               => new CityResource($this->whenLoaded('city')),
            'ethnicity'          => new EthnicityResource($this->whenLoaded('ethnicity')),
        ];
    }
}
