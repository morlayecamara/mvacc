<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateZambiaHealthFacilityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('zambia_health_facility', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name');
            $table->string('province');
            $table->string('district');
            $table->double('lat');
            $table->double('lng');
            $table->integer('Code');

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
        Schema::drop('zambia_health_facility');
    }
}
