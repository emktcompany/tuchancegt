<?php

namespace App\Http\Resources;

class LaborMobilityInterviewResource extends BaseResource
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
            'id'                       => $this->id,
            'gender'                   => $this->gender,
            'ethnicity'                => $this->ethnicity,
            'age'                      => $this->age,
            'state_id'                 => $this->state_id,
            'city_id'                  => $this->city_id,
            'residence'                => $this->residence,
            'academic_level'           => $this->academic_level,
            'title'                    => $this->title,
            'activity'                 => $this->activity,
            'migration_motive'         => $this->migration_motive,
            'stay_years'               => $this->stay_years,
            'stay_months'              => $this->stay_months,
            'stay_activity'            => $this->stay_activity,
            'did_study'                => $this->did_study,
            'did_training'             => $this->did_training,
            'english_level'            => $this->english_level,
            'deportation_count'        => $this->deportation_count,
            'what_was_left_behind'     => $this->what_was_left_behind,
            'will_try_again'           => $this->will_try_again,
            'backhome_ocupation'       => $this->backhome_ocupation,
            'will_look_for_job'        => $this->will_look_for_job,
            'experienced_in'           => $this->experienced_in,
            'experience_years'         => $this->experience_years,
            'other_skills'             => $this->other_skills,
            'wants_job_information'    => $this->wants_job_information,
            'address'                  => $this->address,
            'phone'                    => $this->phone,
            'email'                    => $this->email,
            'gt_business_action'       => $this->gt_business_action,
            'labor_mobility_person_id' => $this->labor_mobility_person_id,
            'created_at'               => $this->asDate('created_at'),
            'person'                   => new LaborMobilityPersonResource($this->whenLoaded('person')),
        ];
    }
}
