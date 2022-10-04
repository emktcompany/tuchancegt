<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLaborMobilityEstatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('labor_mobility_estates', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')
                ->comment('Nombre de la empresa o finca*');
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
            $table->integer('labor_mobility_country_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('labor_mobility_estates');
    }
}
