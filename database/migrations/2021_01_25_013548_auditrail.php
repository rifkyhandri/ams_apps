<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Auditrail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('auditrail', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('ChangedDateandTime',25)->nullable();
            $table->string('UserID',50)->nullable();
            $table->string('Action_Activity',50)->nullable();
            $table->string('Asset_ID',50)->nullable();
            $table->string('Module_Feature',50)->nullable();
            $table->string('Field_Name',50)->nullable();
            $table->json('OldValue_Remark')->nullable();
            $table->json('NewValue_Remark')->nullable();
            $table->string('Other1',50)->nullable();
            $table->string('Other2',255)->nullable();
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
        Schema::dropIfExists('auditrail');
    }
}
