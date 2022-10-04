<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrainingRecordsReportView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->down();

        app('db')->statement("create view report_training_records as (
            select
                c.period,
                year(c.period) as year,
                month(c.period) as month,
                day(c.period) as day,
                c.workshop,
                c.workshop_id,
                c.person,
                c.person_id,
                c.total
            from (
                select
                    date(date_format(training_records.created_at, '%Y-%m-%d')) as period,
                    training_records.workshop_id,
                    training_workshops.name as workshop,
                    training_records.person_id,
                    training_people.full_name as person,
                    count(training_records.id) as total
                from training_records
                    inner join training_workshops on training_workshops.id = training_records.workshop_id
                    inner join training_people on training_people.id = training_records.person_id
                where
                    training_records.deleted_at is null
                group by
                    period, workshop_id, person_id
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
        app('db')->statement('drop view if exists report_training_records');
    }
}
