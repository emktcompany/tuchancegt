<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsToLaborMobilityInterviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('labor_mobility_interviews', function (Blueprint $table) {
            $table->string('what_was_left_behind')
                ->nullable()
                ->comment('En estados Unidos dejó*');
            $table->boolean('will_try_again')
                ->nullable()
                ->comment('Intentará regresar a Estados Unidos*:');
            $table->string('backhome_ocupation')
                ->nullable()
                ->comment('En cuál actividad se ocupará a su retorno a Guatemala*');
            $table->boolean('will_look_for_job')
                ->nullable()
                ->comment('Buscará empleo*:');
            $table->string('experienced_in')
                ->nullable()
                ->comment('En qué actividades tiene experiencia de trabajo:');
            $table->integer('experience_years')
                ->nullable()
                ->comment('Cuantos años de experiencia*:');
            $table->string('other_skills')
                ->nullable()
                ->comment('Otros conocimientos o habilidades que posea:');
            $table->boolean('wants_job_information')
                ->nullable()
                ->comment('Desea información de trabajo, empleo*');
            $table->string('address')
                ->nullable()
                ->comment('Dirección');
            $table->string('phone')
                ->nullable()
                ->comment('Teléfono');
            $table->string('email')
                ->nullable()
                ->comment('Correo electrónico');
            $table->string('gt_business_action')
                ->nullable()
                ->comment('En caso de que hubiese tenido algún negocio en Guatemala*');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('labor_mobility_interviews', function (Blueprint $table) {
            $table->dropColumn([
                'what_was_left_behind',
                'will_try_again',
                'backhome_ocupation',
                'will_look_for_job',
                'experienced_in',
                'experience_years',
                'other_skills',
                'wants_job_information',
                'address',
                'phone',
                'email',
                'gt_business_action',
            ]);
        });
    }
}
