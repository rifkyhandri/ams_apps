<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DbTypeasset extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('db_typeasset', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('id_typeasset',30)->unique();
            $table->text('description')->nullable();
            $table->string('tree_id',5)->nullable();
            $table->string('cloud_id',50)->nullable();
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
        Schema::dropIfExists('db_typeasset');
    }
}
