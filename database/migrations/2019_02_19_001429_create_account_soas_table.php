<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountSoasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('account_soa', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('soa_number');
            $table->integer('account_id');
            $table->integer('ammortization_id');
            $table->decimal('due_ammount');
            $table->date('due_date');
            $table->decimal('balance_amount');
            $table->decimal('interest_amount');
            $table->decimal('total_ammount_due');
            $table->integer('account_soa_status_id');
            $table->integer('updated_by');
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
        Schema::dropIfExists('account_soa');
    }
}
