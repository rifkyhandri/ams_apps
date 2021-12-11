<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DbClass extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('db_assetclass', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('classcode',15)->unique();
            $table->string('classdesc',75)->nullable();
            $table->string('tree_id',5)->nullable();
            $table->string('cloud_id',50)->nullable();
            $table->string('book_value',25)->nullable();
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
        Schema::dropIfExists('db_assetclass');
    }
}
