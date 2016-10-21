<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttlogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attlog', function (Blueprint $table) {
            $table->increments('id');
            $table->dateTime('datetime');
            $table->date('date');
            $table->time('time');
            $table->integer('finger_id');
            $table->integer('finger_group_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('attlog');
    }
}
