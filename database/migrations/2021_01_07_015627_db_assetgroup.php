<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DbAssetgroup extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('db_assetgroup', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('groupcode',25)->unique();
            $table->string('groupname',50)->nullable();
            $table->string('bookvalrate',10)->nullable();
            $table->string('life',5)->nullable();
            $table->string('Building',5)->nullable();
            $table->string('Ledger1',25)->nullable();
            $table->string('Ledger2',25)->nullable();
            $table->string('Ledger3',25)->nullable();
            $table->string('Ledger4',25)->nullable();
            $table->string('Ledger5',25)->nullable();
            $table->string('Ledger6',25)->nullable();
            $table->string('Ledger7',25)->nullable();
            $table->string('bookdepreciation',20)->nullable();
            $table->string('bookdeptrate',5)->nullable();
            $table->string('taxdepreciation',20)->nullable();
            $table->string('taxdeprate',5)->nullable();
            $table->string('cloud_id',50)->nullable();
            $table->string('qty',10)->nullable();
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
        Schema::dropIfExists('db_assetgroup');
    }
}
