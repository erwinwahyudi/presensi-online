<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('finger_id');
            $table->string('username');
            $table->string('password');
            $table->string('nama');
            $table->string('nip');
            $table->string('jabatan');
            $table->string('golongan');
            $table->string('foto');
            $table->string('level');
            $table->string('email')->unique();            
            $table->integer('group_id');
            $table->integer('kelompok_id');
            $table->rememberToken();
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
        Schema::drop('users');
    }
}
