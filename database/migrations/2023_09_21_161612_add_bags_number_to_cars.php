<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

final class AddBagsNumberToCars extends Migration
{
    public function up()
    {
        DB::update('UPDATE `cars` SET created = \'2000-01-01 00:00:00\' WHERE created = 0');

        Schema::table('cars', function (Blueprint $table) {
            $table->unsignedTinyInteger('bags_number')->after('pass_number');
        });
    }

    public function down()
    {
        Schema::table('cars', function (Blueprint $table) {
            $table->dropColumn('bags_number');
        });
    }
}
