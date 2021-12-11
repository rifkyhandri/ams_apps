<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DbAsset extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('db_asset', function (Blueprint $table) {
            $table->bigIncrements('asset_id');
            $table->string('old_tagnumber',50)->nullable();
            $table->string('tangnumber',50)->unique()->nullable();
            $table->string('serial',25)->nullable();
            $table->string('asset_type',50)->nullable();
            $table->string('assetname',150)->nullable();
            $table->string('models',25)->nullable();
            $table->string('notes',25)->nullable();
            $table->string('vendors',50)->nullable();
            $table->string('payment',10)->nullable();
            $table->string('account',25)->nullable();
            $table->string('datepurchase',15)->nullable();
            $table->string('dateacq',15)->nullable();
            $table->string('purchasecost',25)->nullable();
            $table->string('purchaseacq',25)->nullable();
            $table->string('lifetimeyear',5)->nullable();
            // $table->string('lifetimeyear_f',5)->nullable();
            $table->string('livetimemonth',5)->nullable();
            // $table->string('livetimemonth_f',5)->nullable();
            $table->string('bookrate',5)->nullable();
            // $table->string('bookrate2',5)->nullable();
            $table->string('assetclass',50)->nullable();
            $table->string('assetgroup',50)->nullable();
            $table->string('location',50)->nullable();
            $table->string('costcenter',50)->nullable();
            $table->string('custodian',50)->nullable();
            $table->string('serviceprovider',50)->nullable();
            $table->string('nextservice',15)->nullable();
            $table->string('warranty',15)->nullable();
            $table->string('servicecontract',50)->nullable();
            $table->string('comdepreciation',50)->nullable();
            $table->string('fiscaldepreciation',50)->nullable();
            // $table->string('transferdate',50)->nullable();
            // $table->string('asActive',15)->nullable();
            $table->string('asCondition',50)->nullable();
            $table->string('last_transactions',25)->nullable();
            // $table->string('tanggalso',25)->nullable();
            // $table->string('adminso',25)->nullable();
            $table->string('stock_opname',50)->nullable();
            $table->string('salvage1',25)->nullable();
            // $table->string('salvage2',25)->nullable();
            $table->string('filename',255)->nullable();
            // $table->binary('filedata')->nullable();
            $table->string('departement',15)->nullable();
            $table->string('gps_lat',25)->nullable();
            $table->string('gps_long',25)->nullable();
            $table->string('tagged',15)->nullable();
            // $table->string('cloud_id',50)->nullable();
            $table->string('brand',50)->nullable();
            $table->string('manufacture',50)->nullable();
            $table->string('partnumber',50)->nullable();
            // $table->string('golonganasset',50)->nullable();
            $table->string('ownership',50)->nullable();
            // $table->string('Warehouse',50)->nullable();
            // $table->string('useasset',50)->nullable();
            $table->string('asstatus',50)->nullable();
            // $table->string('typeasset',50)->nullable();
            $table->string('IP',50)->nullable();
            $table->string('ESN',50)->nullable();
            $table->string('att1')->nullable();
            $table->string('att2')->nullable();
            $table->string('att3')->nullable();
            // $table->string('f_att1',50)->nullable();
            // $table->string('f_att2',50)->nullable();
            // $table->string('f_att3',50)->nullable();
            $table->string('upload_date',20)->nullable();
            $table->string('deprec_value',25)->nullable();
            $table->string('curr_value',25)->nullable();
            $table->string('journaldesc',50)->nullable();
            $table->string('journaldate',25)->nullable();
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
        Schema::dropIfExists('db_asset');
    }
}
