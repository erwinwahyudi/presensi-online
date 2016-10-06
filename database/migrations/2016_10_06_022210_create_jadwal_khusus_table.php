<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJadwalKhususTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jadwal_khusus', function (Blueprint $table){
            $table->increments('id');
            $table->string('keterangan');
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
            $table->time('awal_masuk');
            $table->time('akhir_masuk');
            $table->time('awal_masuk_jumat');
            $table->time('akhir_masuk_jumat');
            $table->integer('absen_istirahat');
            $table->time('awal_istirahat');
            $table->time('akhir_istirahat');
            $table->time('awal_istirahat_jumat');
            $table->time('akhir_istirahat_jumat');
            $table->time('awal_masuk_istirahat');
            $table->time('akhir_masuk_istirahat');
            $table->time('awal_masuk_istirahat_jumat');
            $table->time('akhir_masuk_istirahat_jumat');
            $table->integer('absen_pulang');
            $table->time('awal_pulang');
            $table->time('akhir_pulang');
            $table->time('awal_pulang_jumat');
            $table->time('akhir_pulang_jumat');
            $table->string('created_by');
            $table->integer('group_id');
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
        Schema::drop('jadwal_khusus');
    }
}
