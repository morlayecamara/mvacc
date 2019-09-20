<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatrZambiaChildrenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('zambia_children', function (Blueprint $table) {
            $table->increments('id_record');

            $table->string('uuid');
            $table->integer('under5_id');
            $table->dateTime('dob');
            $table->string('sex');
            $table->string('province');
            $table->string('district');
            $table->string('health_facility');
            $table->string('location');
            $table->string('chw_phone');
            $table->string('mother_phone');
            $table->string('zone');
            $table->string('Name');
            $table->string('Birth');
            $table->string('mvacc_id');
            $table->string('reason');
            $table->string('dist_faci_zone');
            $table->integer('age');

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
        Schema::drop('zambia_children');
    }
}