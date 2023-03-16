<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;
use Jenssegers\Mongodb\Schema\Blueprint;

class AddKendaraanIdToMotorCollection extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mongodb')->table('motor', function (Blueprint $collection) {
            $collection->string('kendaraan_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('mongodb')->table('motor', function (Blueprint $collection) {
            $collection->dropColumn('kendaraan_id');
        });
    }
}
