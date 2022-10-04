<?php

namespace App\TuChance\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Nicolaslopezj\Searchable\SearchableTrait;

class LaborMobilityReturn extends Model
{
    use SoftDeletes, SearchableTrait;

    /**
     * @inheritdoc
     */
    protected $fillable = [
        'state', 'county', 'province', 'city', 'contract_init', 'contract_end',
        'position', 'contract_type', 'contract_number', 'weekly_hours',
        'day_wage', 'is_farming', 'labor_mobility_person_id',
        'labor_mobility_estate_id', 'labor_mobility_country_id'
    ];

    /**
     * @inheritdoc
     */
    protected $dates = ['contract_init', 'contract_end'];

    /**
     * @inheritdoc
     */
    protected $with = ['country', 'estate', 'person'];

    /**
     * Searchable rules.
     * @var array
     */
    protected $searchable = [
        'columns' => [
            'name' => 10,
            'state' => 5,
            'province' => 5,
            'city' => 5,
            'county' => 5,
        ]
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

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function estate()
    {
        return $this->belongsTo(
            LaborMobilityEstate::class,
            'labor_mobility_estate_id'
        );
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function country()
    {
        return $this->belongsTo(
            LaborMobilityCountry::class,
            'labor_mobility_country_id'
        );
    }
}
