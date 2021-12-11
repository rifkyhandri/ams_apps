<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDbLocationSubTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('db_location_sm', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('locationcode_sm',50)->unique();
            $table->string('locationname_sm',50)->nullable();
            $table->integer('locationcode_big')->nullable();
            $table->integer('locationcode_sub')->nullable();
            $table->string('contact',30)->nullable();
            $table->text('address_sm')->nullable();
            $table->date('OpeningDate')->nullable();
            $table->string('city',25)->nullable();
            $table->string('phone',30)->nullable();
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
        Schema::dropIfExists('db_location_sub');
    }
}
