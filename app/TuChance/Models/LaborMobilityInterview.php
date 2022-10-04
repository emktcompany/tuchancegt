<?php

namespace App\TuChance\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LaborMobilityInterview extends Model
{
    use SoftDeletes;

    /**
     * @inheritdoc
     */
    protected $fillable = [
        'gender', 'ethnicity', 'age', 'state_id', 'city_id', 'residence',
        'academic_level', 'title', 'activity', 'migration_motive',
        'stay_years', 'stay_months', 'stay_activity', 'did_study',
        'did_training', 'english_level', 'deportation_count',
        'labor_mobility_person_id', 'what_was_left_behind', 'will_try_again',
        'backhome_ocupation', 'will_look_for_job', 'experienced_in',
        'experience_years', 'other_skills', 'wants_job_information', 'address',
        'phone', 'email', 'gt_business_action'
    ];

    /**
     * @inheritdoc
     */
    protected $with = ['person'];

    /**
     * @inheritdoc
     */
    protected $casts = [
        'migration_motive' => 'array',
        'stay_activity' => 'array',
        'what_was_left_behind' => 'array',
        'experienced_in' => 'array',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function person()
    {
        return $this->belongsTo(
            LaborMobilityPerson::class,
            'labor_mobility_person_id'
        );
    }
}
