<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SubLocation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('db_location_sub', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('locationcode_sub',50)->unique();
            $table->string('locationname_sub',50)->nullable();
            $table->integer('locationcode_big')->nullable();
            $table->string('contact',30)->nullable();
            $table->text('address')->nullable();
            $table->date('OpeningDate')->nullable();
            $table->string('city',25)->nullable();
            $table->string('postal',10)->nullable();
            $table->string('phone',30)->nullable();
            $table->string('fax',15)->nullable();
            $table->string('telex',15)->nullable();
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
