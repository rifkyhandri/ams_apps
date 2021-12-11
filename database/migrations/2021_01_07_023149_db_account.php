<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DbAccount extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('db_account', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('accountno',25)->unique();
            $table->string('accountname',50)->nullable();
            $table->string('accountshortname',25)->nullable();
            $table->string('accountgroup',25)->nullable();
            $table->string('oldaccount',25)->nullable();
            $table->string('subgroup',25)->nullable();
            $table->string('type',25)->nullable();
            $table->string('level',5)->nullable();
            $table->string('generalaccount',25)->nullable();
            $table->string('consolidationaccount',25)->nullable();
            $table->string('reconcile',15)->nullable();
            $table->string('status',15)->nullable();
            $table->string('cloud_id',50)->nullable();
            $table->text('Other2')->nullable();
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
        Schema::dropIfExists('db_account');
    }
}
