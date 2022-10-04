<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveLaborMobilityCountryFromLaborMobilityPeopleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('labor_mobility_people', function (Blueprint $table) {
            $table->dropColumn('labor_mobility_country_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('labor_mobility_people', function (Blueprint $table) {
            $table->integer('labor_mobility_country_id')->nullable();
        });
    }
}
