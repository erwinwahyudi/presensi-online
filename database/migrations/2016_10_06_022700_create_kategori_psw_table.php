<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKategoriPswTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kategori_psw', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('level_psw');
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
        Schema::drop('kategori_psw');
    }
}
