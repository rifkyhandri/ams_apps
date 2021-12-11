<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DbCustodian extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('db_custodian', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('custodiancode',100)->unique();
            $table->string('custodianname',100)->nullable();
            $table->string('contact',30)->nullable();
            $table->text('address')->nullable();
            $table->string('OpeningDate',15)->nullable();
            $table->string('phone',30)->nullable();
            $table->string('city',25)->nullable();
            $table->string('postal',10)->nullable();
            $table->string('fax',15)->nullable();
            $table->string('telex',15)->nullable();
            $table->string('cloud_id',50)->nullable();
            $table->string('email',30)->nullable();
            $table->string('usertype',30)->nullable();
            $table->string('company',30)->nullable();
            $table->string('tree_id',5)->nullable();
            $table->string('status',10)->nullable();
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
        Schema::dropIfExists('db_custodian');
    }
}
