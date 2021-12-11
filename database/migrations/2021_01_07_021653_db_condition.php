<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DbCondition extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('db_condition', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('conditioncode',25)->unique();
            $table->text('conditiondesc')->nullable();
            $table->string('cloud_id',50)->nullable();
            $table->string('rbo_user',50)->nullable();
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
        Schema::dropIfExists('db_condition');
    }
}
