<?php

namespace App\TuChance\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Nicolaslopezj\Searchable\SearchableTrait;

class LaborMobilityEstate extends Model
{
    use SoftDeletes, SearchableTrait;

    /**
     * @inheritdoc
     */
    protected $fillable = [
        'name', 'state', 'province', 'city', 'county',
        'labor_mobility_country_id', 'city_id', 'state_id', 'country_id',
    ];

    /**
     * Searchable rules.
     * @var array
     */
    protected $searchable = [
        'columns' => [
            'name'     => 10,
            'state'    => 5,
            'province' => 5,
            'city'     => 5,
            'county'   => 5,
        ],
    ];

    protected $with = ['country'];

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
