<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePerhitunganTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('perhitungan', function (Blueprint $table){
            $table->increments('id');
            $table->integer('users_id');
            $table->string('hari');
            $table->date('tanggal');
            $table->time('masuk_pagi');
            $table->time('istirahat');
            $table->time('masuk_siang');
            $table->time('pulang');
            $table->time('sesi1');
            $table->time('sesi2');
            $table->integer('masuk');
            $table->integer('terlambat');
            $table->integer('kategori_terlambat_id');
            $table->integer('kategori_psw_id');
            $table->string('waktu_ganti_terlambat');
            $table->integer('ganti_terlambat');
            $table->integer('lembur');
            $table->string('total_lembur');
            $table->string('keterangan');
            $table->integer('group_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('perhitungan');
    }
}
