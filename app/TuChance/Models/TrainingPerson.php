<?php

namespace App\TuChance\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Nicolaslopezj\Searchable\SearchableTrait;

class TrainingPerson extends Model
{
    use SoftDeletes, SearchableTrait;

    /**
     * @inheritdoc
     */
    protected $fillable = [
        'first_name', 'middle_name', 'last_name', 'sur_name', 'place_of_birth',
        'date_of_birth', 'age', 'gender', 'ethnicity_id', 'id_number',
        'cui_number', 'address', 'state_id', 'city_id', 'phone', 'phone_alt',
        'email', 'language_community',
    ];

    /**
     * @inheritdoc
     */
    protected $with = ['state', 'city', 'ethnicity'];

    /**
     * @inheritdoc
     */
    protected $dates = ['date_of_birth'];

    /**
     * Searchable rules.
     * @var array
     */
    protected $searchable = [
        'columns' => [
            'full_name' => 10,
            'first_name' => 7,
            'middle_name' => 7,
            'last_name' => 7,
            'sur_name' => 7,
            'email' => 5,
            'id_number' => 5,
        ],
    ];

    /**
     * Ethnicity the person registered belongs to
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function state()
    {
        return $this->belongsTo(State::class);
    }

    /**
     * Ethnicity the person registered belongs to
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function city()
    {
        return $this->belongsTo(City::class);
    }

    /**
     * Ethnicity the person registered belongs to
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function ethnicity()
    {
        return $this->belongsTo(Ethnicity::class);
    }

    /**
     * @inheritdoc
     */
    static public function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            $model->full_name = implode(' ', array_filter([
                $model->first_name,
                $model->middle_name,
                $model->last_name,
                $model->sur_name,
            ]));
        });
    }
}
