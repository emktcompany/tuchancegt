<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLaborMobilityReturnsReportView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->down();

        app('db')->statement("create view report_labor_mobility_returns as (
            select
                c.period,
                year(c.period) as year,
                month(c.period) as month,
                day(c.period) as day,
                c.country,
                c.labor_mobility_country_id,
                c.estate,
                c.labor_mobility_estate_id,
                c.person,
                c.labor_mobility_person_id,
                c.is_farming,
                c.total
            from (
                select
                    date(date_format(labor_mobility_returns.created_at, '%Y-%m-%d')) as period,
                    labor_mobility_returns.labor_mobility_country_id,
                    labor_mobility_countries.name as country,
                    labor_mobility_returns.labor_mobility_estate_id,
                    labor_mobility_estates.name as estate,
                    labor_mobility_returns.labor_mobility_person_id,
                    labor_mobility_people.full_name as person,
                    is_farming,
                    count(labor_mobility_returns.id) as total
                from labor_mobility_returns
                    inner join labor_mobility_countries on labor_mobility_countries.id = labor_mobility_returns.labor_mobility_country_id
                    inner join labor_mobility_estates on labor_mobility_estates.id = labor_mobility_returns.labor_mobility_estate_id
                    inner join labor_mobility_people on labor_mobility_people.id = labor_mobility_returns.labor_mobility_person_id
                where
                    labor_mobility_returns.deleted_at is null
                group by
                    period, labor_mobility_country_id, labor_mobility_estate_id, labor_mobility_person_id, is_farming
                order by
                    period desc
            ) as c
        )");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        app('db')->statement('drop view if exists report_labor_mobility_returns');
    }
}
