<?php

namespace App\Http\Resources;

class LaborMobilityPersonResource extends BaseResource
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
            'full_name'                 => $this->full_name,
            'first_name'                => $this->first_name,
            'middle_name'               => $this->middle_name,
            'last_name'                 => $this->last_name,
            'sur_name'                  => $this->sur_name,
            'married_name'              => $this->married_name,
            'gender'                    => $this->gender,
            'id_type'                   => $this->id_type,
            'id_number'                 => $this->id_number,
            'usa_visa'                  => $this->usa_visa,
            'usa_visa_type'             => $this->usa_visa_type,
            'usa_labor_offer'           => $this->usa_labor_offer,
            'mex_id_number'             => $this->mex_id_number,
            'can_visa'                  => $this->can_visa,
            'can_lmia'                  => $this->can_lmia,
            'can_offer'                 => $this->can_offer,
            'passport_number'           => $this->passport_number,
            'birth'                     => $this->asDate('birth'),
            'marital_status'            => $this->marital_status,
            'children'                  => $this->children,
            'state_id'                  => $this->state_id,
            'city_id'                   => $this->city_id,
            'address'                   => $this->address,
            'ethnicity'                 => $this->ethnicity,
            'language'                  => $this->language,
            'academic_level'            => $this->academic_level,
            'profession'                => $this->profession,
            'phone_number'              => $this->phone_number,
            'phone_number_alt'          => $this->phone_number_alt,
            'email'                     => $this->email,
            'emergency_contact'         => $this->emergency_contact,
            'emergency_phone'           => $this->emergency_phone,
            'emergency_email'           => $this->emergency_email,
            'labor_mobility_country_id' => $this->labor_mobility_country_id,
            'created_at'                => $this->asDate('created_at'),
        ];
    }
}
