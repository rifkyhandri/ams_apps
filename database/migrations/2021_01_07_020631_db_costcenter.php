<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DbCostcenter extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('db_costcenter', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('costcentercode',25)->unique();
            $table->string('costcenterdesc',50)->nullable();
            $table->string('cloud_id',50)->nullable();
            $table->string('coa',25)->nullable();
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
        Schema::dropIfExists('db_costcenter');
    }
}
