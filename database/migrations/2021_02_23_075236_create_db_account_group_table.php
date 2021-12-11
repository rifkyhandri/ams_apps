<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDbAccountGroupTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('db_account_group', function (Blueprint $table) {
            $table->id();
            $table->string('id_account_group');
            $table->string('account_group_name',50);
            $table->timestamps();
        });
        Schema::create('db_account_sub', function (Blueprint $table) {
            $table->id();
            $table->string('id_db_account_group');
            $table->string('id_account_sub');
            $table->string('account_sub_name',50);
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
        Schema::dropIfExists('db_account_group');
        Schema::dropIfExists('db_account_sub');
    }
}
