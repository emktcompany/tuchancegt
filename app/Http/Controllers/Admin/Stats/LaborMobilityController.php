<?php

namespace App\Http\Controllers\Admin\Stats;

use App\TuChance\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\JsonResponse;

class LaborMobilityController extends BaseController
{
    public function index()
    {
        $main = $this->main();
        $top_estates = $this->topEstates();
        $top_people = $this->topPeople();
        $top_countries = $this->topCountries();

        return new JsonResponse(compact(
            'main', 'top_estates', 'top_people', 'top_countries'
        ));
    }

    public function main()
    {
        $datasets = collect([
            'Ingresados' => 'report_labor_mobility_returns',
            // 'active'  => null
        ])
            ->map(function ($table) {
                if (!$table) {
                    return null;
                }

                $query = $this->countQuery(
                    $table,
                    ['period'],
                    ['period'],
                    'period'
                );

                $this->filterQuery($query);

                return $query->get();
            });

        $begin = $this->earliestDateInCollection($datasets->first());
        $steps = $this->steps($begin);

        $labels = $steps->keys();

        $datasets = $datasets->map(function ($data) use ($steps) {
            return $steps->map(function ($step, $label) use ($data) {

                if ($step) {
                    return $data->filter(function ($row) use ($step) {
                        $time = strtotime($row->period);
                        $then = Carbon::createFromTimestamp($time);
                        return $then->between($step['begin'], $step['end']);
                    })->sum('count');
                }

                return $data ? $data->where('period', null)->sum('count') : 0;
            })->values();
        });

        return compact('datasets', 'labels');
    }

    /**
     * Get top bidders with the most opportunities
     * @return \Illuminate\Support\Collection
     */
    public function topEstates()
    {
        return $this->countQuery(
            'report_labor_mobility_returns',
            ['estate'],
            ['labor_mobility_estate_id']
        )->whereNotNull('estate')->take(5)->get();
    }

    /**
     * Get top bidders with the most opportunities
     * @return \Illuminate\Support\Collection
     */
    public function topPeople()
    {
        return $this->countQuery(
            'report_labor_mobility_returns',
            ['person'],
            ['labor_mobility_person_id']
        )->whereNotNull('person')->take(5)->get();
    }

    /**
     * Get top bidders with the most opportunities
     * @return \Illuminate\Support\Collection
     */
    public function topCountries()
    {
        return $this->countQuery(
            'report_labor_mobility_returns',
            ['country'],
            ['labor_mobility_country_id']
        )->whereNotNull('country')->take(5)->get();
    }
}
