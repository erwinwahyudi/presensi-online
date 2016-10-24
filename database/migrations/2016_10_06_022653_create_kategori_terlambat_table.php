<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKategoriTerlambatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kategori_terlambat', function (Blueprint $table) {
            $table->integer('id');
            $table->integer('level_terlambat');
            $table->time('rentang_awal');
            $table->time('rentang_akhir');
            $table->string('waktu');
            $table->string('pengurangan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('kategori_terlambat');
    }
}
