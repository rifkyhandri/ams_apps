<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DbDepartement extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('db_departement', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('departementcode',15)->unique();
            $table->string('departementdesc',75)->nullable();
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
        Schema::dropIfExists('db_departement');
    }
}
