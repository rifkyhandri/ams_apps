<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DbProvider extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('db_provider', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('providercode',100)->unique();
            $table->string('providername',100)->nullable();
            $table->string('contact',25)->nullable();
            $table->text('address')->nullable();
            $table->string('OpeningDate',15)->nullable();
            $table->string('city',25)->nullable();
            $table->string('postal',10)->nullable();
            $table->string('phone',30)->nullable();
            $table->string('fax',15)->nullable();
            $table->string('telex',15)->nullable();
            $table->string('cloud_id',50)->nullable();
            $table->string('tree_id',5)->nullable();
            $table->string('pr40',1)->nullable();
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
        Schema::dropIfExists('db_provider');
    }
}
