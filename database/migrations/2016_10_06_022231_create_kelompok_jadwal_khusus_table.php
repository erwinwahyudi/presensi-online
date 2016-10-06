<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKelompokJadwalKhususTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kelompok_jadwal_khusus', function(Blueprint $table){
            $table->increments('id');
            $table->integer('kelompok_id');
            $table->integer('jadwal_khusus_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('kelompok_jadwal_khusus');
    }
}
