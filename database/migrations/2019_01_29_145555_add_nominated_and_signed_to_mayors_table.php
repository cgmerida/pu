<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNominatedAndSignedToMayorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mayors', function (Blueprint $table) {
            $table->boolean('nominated')->default(false)->after('name');
            $table->boolean('signed_up')->default(false)->after('nominated');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mayors', function (Blueprint $table) {
            $table->dropColumn('nominated');
            $table->dropColumn('signed_up');
        });
    }
}
