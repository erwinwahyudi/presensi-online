<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKelompokTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kelompok', function (Blueprint $table){
            $table->increments('id');
            $table->string('nama_kelompok');
            $table->integer('group_id');
            $table->time('awal_masuk');
            $table->time('akhir_masuk');
            $table->time('awal_masuk_jumat');
            $table->time('akhir_masuk_jumat');
            $table->integer('absen_istirahat');
            $table->time('awal_istirahat');
            $table->time('akhir_istirahat');
            $table->time('awal_istirahat_jumat');
            $table->time('akhir_istirahat_jumat');
            $table->integer('absen_masuk_istirahat');
            $table->time('awal_masuk_istirahat');
            $table->time('akhir_masuk_istirahat');
            $table->time('awal_masuk_istirahat_jumat');
            $table->time('akhir_masuk_istirahat_jumat');
            $table->integer('absen_pulang');
            $table->time('awal_pulang');
            $table->time('akhir_pulang');
            $table->time('awal_pulang_jumat');
            $table->time('akhir_pulang_jumat');
            $table->integer('hitung_lembur');
            $table->string('nama_penandatangan1');
            $table->string('nip_penandatangan1');
            $table->string('jabatan_penandatangan1');
            $table->string('nama_penandatangan2');
            $table->string('nip_penandatangan2');
            $table->string('jabatan_penandatangan2');
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
        Schema::drop('kelompok');
    }
}
