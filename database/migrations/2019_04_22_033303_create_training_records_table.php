<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrainingRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('training_records', function (Blueprint $table) {
            $table->increments('id');
            $table->string('contact_name')->nullable();
            $table->string('contact_phone')->nullable();
            $table->string('parent_first_name')->nullable();
            $table->string('parent_middle_name')->nullable();
            $table->string('parent_last_name')->nullable();
            $table->string('parent_sur_name')->nullable();
            $table->string('parent_kinship')->nullable();
            $table->integer('parent_age')->nullable();
            $table->string('parent_id_number')->nullable();
            $table->string('parent_cui_number')->nullable();
            $table->string('parent_workplace')->nullable();
            $table->string('parent_phone')->nullable();
            $table->string('parent_email')->nullable();
            $table->boolean('can_read')->nullable();
            $table->string('study_sessions')->nullable();
            $table->string('study_schedule')->nullable();
            $table->integer('workshop_id')->unsigned()->nullable();
            $table->integer('person_id')->unsigned()->nullable();
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
        Schema::dropIfExists('training_records');
    }
}
