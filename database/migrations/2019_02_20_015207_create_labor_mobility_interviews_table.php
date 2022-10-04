<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLaborMobilityInterviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('labor_mobility_interviews', function (Blueprint $table) {
            $table->increments('id');
            $table->string('gender')
                ->nullable()
                ->comment('Género*');
            $table->string('ethnicity')
                ->nullable()
                ->comment('Etnia*');
            $table->integer('age')
                ->nullable()
                ->comment('Edad*');
            $table->integer('state_id')
                ->unsigned()
                ->nullable()
                ->comment('Departamento origen*');
            $table->integer('city_id')
                ->unsigned()
                ->nullable()
                ->comment('Municipio origen*');
            $table->string('residence')
                ->nullable()
                ->comment('Lugar de residencia*- ');
            $table->string('academic_level')
                ->nullable()
                ->comment('Ultimo grado aprobado*');
            $table->string('title')
                ->nullable()
                ->comment('Título*');
            $table->string('activity')
                ->nullable()
                ->comment('Actividad o trabajo que realizaba en Guatemala*: ');
            $table->string('migration_motive')
                ->nullable()
                ->comment('Causas de emigración*: ');
            $table->integer('stay_years')
                ->nullable()
                ->comment('Tiempo que permaneció en el extranjero*: Años____');
            $table->integer('stay_months')
                ->nullable()
                ->comment('Tiempo que permaneció en el extranjero*: meses____');
            $table->string('stay_activity')
                ->nullable()
                ->comment('En qué actividades trabajo o se ocupó durante su estadía en el extranjero*:');
            $table->boolean('did_study')
                ->nullable()
                ->comment('Realizó algún tipo de estudios:* ');
            $table->boolean('did_training')
                ->nullable()
                ->comment('Recibió algún tipo de capacitación para el trabajo*:');
            $table->string('english_level')
                ->nullable()
                ->comment('Nivel del idioma ingles:* ');
            $table->integer('deportation_count')
                ->nullable()
                ->comment('Cuántas veces ha sido deportado incluyendo esta:* ');
            $table->integer('labor_mobility_person_id')->unsigned();
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
        Schema::dropIfExists('labor_mobility_interviews');
    }
}
