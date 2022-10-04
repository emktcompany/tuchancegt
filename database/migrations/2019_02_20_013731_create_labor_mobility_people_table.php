<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLaborMobilityPeopleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('labor_mobility_people', function (Blueprint $table) {
            $table->increments('id');
            $table->string('full_name')
                ->nullable()
                ->comment('Nombre Completo*');
            $table->string('first_name')
                ->nullable()
                ->comment('Primer Nombre*');
            $table->string('middle_name')
                ->nullable()
                ->comment('Segundo Nombre');
            $table->string('last_name')
                ->nullable()
                ->comment('Primer Apellido*');
            $table->string('sur_name')
                ->nullable()
                ->comment('Segundo Apellido');
            $table->string('married_name')
                ->nullable()
                ->comment('Apellido de casada');
            $table->string('gender')
                ->nullable()
                ->comment('genero*');
            $table->string('id_type')
                ->nullable()
                ->comment('Tipo Documento*');
            $table->string('id_number')
                ->nullable()
                ->comment('Numero de CUI*');
            $table->string('usa_visa')
                ->nullable()
                ->comment('No. De visa Estadunidense*');
            $table->string('usa_visa_type')
                ->nullable()
                ->comment('tipo de visa (H-2ª/H-2B)');
            $table->string('usa_labor_offer')
                ->nullable()
                ->comment('Oferta Laboral Estadunidense*');
            $table->string('mex_id_number')
                ->nullable()
                ->comment('Numero de tarjeta de visitante de trabajador fronterizo (opcional)');
            $table->string('can_visa')
                ->nullable()
                ->comment('No. De visa Canadiense*');
            $table->string('can_lmia')
                ->nullable()
                ->comment('LMIA (Labour Market Impact Assessment)*');
            $table->string('can_offer')
                ->nullable()
                ->comment('Oferta Laboral canadiense');
            $table->string('passport_number')
                ->nullable()
                ->comment('Número de pasaporte*');
            $table->date('birth')
                ->nullable()
                ->comment('Fecha de Nacimiento');
            $table->string('marital_status')
                ->nullable()
                ->comment('Estado civil*');
            $table->integer('children')
                ->nullable()
                ->comment('Número de hijos*');
            $table->integer('state_id')
                ->unsigned()
                ->nullable()
                ->comment('Departamento de Nacimiento');
            $table->integer('city_id')
                ->unsigned()
                ->nullable()
                ->comment('Municipio de Nacimiento');
            $table->string('address')
                ->nullable()
                ->comment('Dirección*');
            $table->string('ethnicity')
                ->nullable()
                ->comment('Etnia*');
            $table->string('language')
                ->nullable()
                ->comment('Idioma*');
            $table->string('academic_level')
                ->nullable()
                ->comment('Nivel académico*');
            $table->string('profession')
                ->nullable()
                ->comment('Profesión u Oficio*');
            $table->string('phone_number')
                ->nullable()
                ->comment('número de teléfono 1*');
            $table->string('phone_number_alt')
                ->nullable()
                ->comment('número de teléfono 2 opcional');
            $table->string('email')
                ->nullable()
                ->comment('correo electrónico*.');
            $table->string('emergency_contact')
                ->nullable()
                ->comment('Nombre de contacto en Guatemala*');
            $table->string('emergency_phone')
                ->nullable()
                ->comment('Número de teléfono*');
            $table->string('emergency_email')
                ->nullable()
                ->comment('correo electrónico del contacto*. ');
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
        Schema::dropIfExists('labor_mobility_people');
    }
}
