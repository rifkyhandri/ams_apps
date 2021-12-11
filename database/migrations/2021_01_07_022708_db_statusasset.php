<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DbStatusasset extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('db_statusasset', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('id_statusasset',30)->unique();
            $table->string('description',50)->nullable();
            $table->string('tree_id',5)->nullable();
            $table->time('time_login')->nullable();
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
        //
        Schema::dropIfExists('db_statusasset');
    }
}
