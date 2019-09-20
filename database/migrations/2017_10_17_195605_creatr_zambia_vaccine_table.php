<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatrZambiaVaccineTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('zambia_vaccine', function (Blueprint $table) {
            $table->increments('id');

            $table->string('uuid');
            $table->integer('under5_id');
            $table->string('vaccine');

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
        Schema::drop('zambia_vaccine');
    }
}
