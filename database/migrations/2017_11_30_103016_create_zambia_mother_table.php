<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateZambiaMotherTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('zambia_mother', function (Blueprint $table) {
            $table->increments('id');

            $table->string('uuid');
            $table->string('mother_name');
            $table->string('mother_phone'); 
            $table->string('province');
            $table->string('district');
            $table->string('health_facility');
            $table->string('location'); 
            $table->string('zone');
            $table->string('chw_phone');

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
        Schema::drop('zambia_mother');
    }
}
