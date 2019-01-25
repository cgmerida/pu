<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMayorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mayors', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('department_id')->unsigned();
            $table->integer('municipality_id')->unsigned();

            $table->foreign('department_id')->references('id')->on('departments')->onDelete('cascade');
            $table->foreign('municipality_id')->references('id')->on('municipalities')->onDelete('cascade');

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
        Schema::dropIfExists('mayors');
    }
}
