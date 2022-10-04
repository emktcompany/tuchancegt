<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLaborMobilityReturnsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('labor_mobility_returns', function (Blueprint $table) {
            $table->increments('id');
            $table->string('state')
                ->nullable()
                ->comment('Provincia o territorio*');
            $table->string('county')
                ->nullable()
                ->comment('condado');
            $table->string('province')
                ->nullable()
                ->comment('Provincia');
            $table->string('city')
                ->nullable()
                ->comment('Ciudad*');
            $table->date('contract_init')
                ->nullable()
                ->comment('Fecha inicio de contrato*');
            $table->date('contract_end')
                ->nullable()
                ->comment('Fecha finalización de contrato*');
            $table->string('position')
                ->nullable()
                ->comment('Puesto*');
            $table->string('contract_type')
                ->nullable()
                ->comment('Tipo de Contrato*');
            $table->string('contract_number')
                ->nullable()
                ->comment('# de contrato*');
            $table->integer('weekly_hours')
                ->nullable()
                ->comment('Mínimo de horas trabajadas semanalmente');
            $table->double('day_wage', 10, 2)
                ->nullable()
                ->comment('Salario por día');
            $table->boolean('is_farming')
                ->nullable()
                ->comment('Tipo de trabajo (agrícola o no agrícola)*');
            $table->integer('labor_mobility_person_id')->unsigned();
            $table->integer('labor_mobility_estate_id')->unsigned();
            $table->integer('labor_mobility_country_id')->unsigned();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('labor_mobility_returns');
    }
}
