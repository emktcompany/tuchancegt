<?php

namespace App\TuChance\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Nicolaslopezj\Searchable\SearchableTrait;

class LaborMobilityCountry extends Model
{
    use SoftDeletes, SearchableTrait;

    /**
     * @inheritdoc
     */
    protected $fillable = ['name', 'remote_id'];

    /**
     * Searchable rules.
     * @var array
     */
    protected $searchable = [
        'columns' => [
            'name' => 10,
        ]
    ];
}
