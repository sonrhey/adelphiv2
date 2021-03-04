<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientBanksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_bank', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('bank_id');
            $table->string('branch_location');
            $table->string('account_number');
            $table->string('account_name');
            $table->string('year_opened');
            $table->integer('client_id');
            $table->integer('added_by');
            $table->integer('updated_by')->nullable();
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
        Schema::dropIfExists('client_bank');
    }
}
