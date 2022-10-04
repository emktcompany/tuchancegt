<?php

namespace App\Http\Controllers\Admin\Stats;

use App\TuChance\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\JsonResponse;

class TrainingController extends BaseController
{
    public function index()
    {
        $main = $this->main();
        $top_workshops = $this->topWorkshops();
        $top_people = $this->topPeople();

        return new JsonResponse(compact(
            'main', 'top_estates', 'top_people'
        ));
    }

    public function main()
    {
        $datasets = collect([
            'Ingresados' => 'report_training_records',
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
    public function topWorkshops()
    {
        return $this->countQuery(
            'report_training_records',
            ['workshop'],
            ['workshop_id']
        )->whereNotNull('workshop')->take(5)->get();
    }

    /**
     * Get top bidders with the most opportunities
     * @return \Illuminate\Support\Collection
     */
    public function topPeople()
    {
        return $this->countQuery(
            'report_training_records',
            ['person'],
            ['person_id']
        )->whereNotNull('person')->take(5)->get();
    }
}
