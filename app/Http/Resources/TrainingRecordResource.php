<?php

namespace App\Http\Resources;

class TrainingRecordResource extends BaseResource
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
            'contact_name'       => $this->contact_name,
            'contact_phone'      => $this->contact_phone,
            'parent_first_name'  => $this->parent_first_name,
            'parent_middle_name' => $this->parent_middle_name,
            'parent_last_name'   => $this->parent_last_name,
            'parent_sur_name'    => $this->parent_sur_name,
            'parent_kinship'     => $this->parent_kinship,
            'parent_age'         => $this->parent_age,
            'parent_id_number'   => $this->parent_id_number,
            'parent_cui_number'  => $this->parent_cui_number,
            'parent_workplace'   => $this->parent_workplace,
            'parent_phone'       => $this->parent_phone,
            'parent_email'       => $this->parent_email,
            'can_read'           => $this->can_read,
            'study_sessions'     => $this->study_sessions,
            'study_schedule'     => $this->study_schedule,
            'workshop_id'        => $this->workshop_id,
            'person_id'          => $this->person_id,
            'created_at'         => $this->asDate('created_at'),
            'person'             => new TrainingPersonResource($this->whenLoaded('person')),
            'workshop'           => new TrainingWorkshopResource($this->whenLoaded('workshop')),
        ];
    }
}
