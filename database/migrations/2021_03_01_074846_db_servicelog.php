<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DbServicelog extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('db_servicelog', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('tangnumber',50);
            $table->string('providercode',50)->nullable();
            $table->string('notes',25)->nullable();
            $table->string('servicecontract',50)->nullable();
            $table->string('servicedate',50)->nullable();
            $table->string('nextservice',50)->nullable();
            $table->string('costservice',15)->nullable();
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
        Schema::dropIfExists('db_servicelog');
    }
}
