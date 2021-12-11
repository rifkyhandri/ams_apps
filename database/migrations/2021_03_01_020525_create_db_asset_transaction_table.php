<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDbAssetTransactionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('db_asset_transaction', function (Blueprint $table) {
            $table->bigIncrements('id_asset_transaction');
            $table->integer('asset_id');
            $table->string('tangnumber',50);
            $table->string('transaction_name',50);
            $table->date('transaction_date');
            $table->string('new_tangnumber',50)->nullable();
            $table->string('wd_value',50)->nullable();
            $table->string('sale_ammount',50)->nullable();
            $table->string('diff_total',50)->nullable();
            $table->string('transfer_account',50)->nullable();
            $table->string('revaluation_value',50)->nullable();
            $table->string('revaluation_salvage',50)->nullable();
            $table->string('extend_year',5)->nullable();
            $table->string('extend_month',5)->nullable();
            $table->string('change_location',50)->nullable();
            $table->string('change_costcenter',50)->nullable();
            $table->string('change_custodian',50)->nullable();
            $table->string('change_assetclass',50)->nullable();
            $table->string('change_condition',50)->nullable();
            $table->string('change_tagged',50)->nullable();
            $table->string('change_stock_opname',50)->nullable();
            $table->string('requester',50)->nullable();
            $table->string('approver',50)->nullable();
            $table->boolean('approval');
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
        Schema::dropIfExists('db_asset_transaction');
    }
}
