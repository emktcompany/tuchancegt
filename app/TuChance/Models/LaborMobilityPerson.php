<?php

namespace App\TuChance\Models;

use App\TuChance\Contracts\Locateable as LocateableContract;
use App\TuChance\Eloquent\Locateable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Nicolaslopezj\Searchable\SearchableTrait;

class LaborMobilityPerson extends Model implements LocateableContract
{
    use SoftDeletes, SearchableTrait, Locateable;

    /**
     * @inheritdoc
     */
    protected $fillable = [
        'first_name', 'middle_name', 'last_name', 'sur_name', 'married_name',
        'gender', 'id_type', 'id_number', 'usa_visa', 'usa_visa_type',
        'usa_labor_offer', 'mex_id_number', 'can_visa', 'can_lmia',
        'can_offer', 'passport_number', 'birth', 'marital_status', 'children',
        'state_id', 'city_id', 'address', 'ethnicity', 'language',
        'academic_level', 'profession', 'phone_number', 'phone_number_alt',
        'email', 'emergency_contact', 'emergency_phone', 'emergency_email',
    ];

    /**
     * @inheritdoc
     */
    protected $dates = ['birth'];

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
        ]
    ];

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
                $model->married_name,
            ]));
        });
    }
}
