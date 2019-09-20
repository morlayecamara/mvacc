<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateZambiaPercentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('zambia_percent', function (Blueprint $table) {
            $table->increments('id'); 
            
            $table->string('uuid');  
            $table->integer('age');
            $table->dateTime('dob');
            $table->string('sex');
            $table->string('province');
            $table->string('district');
            $table->string('health_facility');
            $table->string('location');
            $table->string('chw_phone');
            $table->string('mother_phone');
            $table->string('zone');  
            $table->integer('bcg');
            $table->integer('opv');
            $table->integer('dtp');
            $table->integer('pcv');
            $table->integer('rota');
            $table->integer('measles');
            $table->integer('fully'); 
            $table->string('mvacc_id');
            $table->string('dist_faci_zone');   

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
        Schema::drop('zambia_percent');
    }
}