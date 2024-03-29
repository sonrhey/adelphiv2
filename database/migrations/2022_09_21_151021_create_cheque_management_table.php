<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChequeManagementTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cheque_management', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('client_id');
            $table->integer('bank_id');
            $table->string('cheque_name');
            $table->decimal('cheque_value', 18, 2);
            $table->timestamp('cheque_expiry_date');
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
        Schema::dropIfExists('cheque_management');
    }
}
