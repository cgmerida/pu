<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCampaignTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('campaigns', function (Blueprint $table) {
            $table->increments('id');
            $table->dateTime('date');
            $table->integer('number')->unsigned();
            $table->enum('status', ['Pendiente', 'Realizada'])->default('Pendiente');
            $table->integer('department_id')->unsigned();
            $table->integer('municipality_id')->unsigned();

            $table->foreign('department_id')->references('id')->on('departments');
            $table->foreign('municipality_id')->references('id')->on('municipalities');
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
        Schema::dropIfExists('campaign');
    }
}
