<?php

namespace App\TuChance\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Nicolaslopezj\Searchable\SearchableTrait;

class TrainingRecord extends Model
{
    use SoftDeletes, SearchableTrait;

    /**
     * @inheritdoc
     */
    protected $fillable = [
        'contact_name', 'contact_phone', 'parent_first_name',
        'parent_middle_name', 'parent_last_name', 'parent_sur_name',
        'parent_kinship', 'parent_age', 'parent_id_number',
        'parent_cui_number', 'parent_workplace', 'parent_phone',
        'parent_email', 'can_read', 'study_sessions', 'study_schedule',
        'workshop_id', 'person_id'
    ];

    /**
     * @inheritdoc
     */
    protected $with = [
        'person.state', 'person.city', 'person.ethnicity', 'workshop'
    ];

    /**
     * Searchable rules.
     * @var array
     */
    protected $searchable = [
        'columns' => [
            'training_people.full_name' => 10,
            'training_people.first_name' => 7,
            'training_people.middle_name' => 7,
            'training_people.last_name' => 7,
            'training_people.sur_name' => 7,
            'training_people.email' => 5,
            'training_people.id_number' => 5,
        ],
        'joins' => [
            'training_people' => [
                'training_people.id', 'training_records.person_id'
            ],
        ],
    ];

    /**
     * Ethnicity the person registered belongs to
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function person()
    {
        return $this->belongsTo(TrainingPerson::class);
    }

    /**
     * Ethnicity the person registered belongs to
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function workshop()
    {
        return $this->belongsTo(TrainingWorkshop::class);
    }
}
