<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubsidiaryLedgersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subsidiary_ledgers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('accountable_type');
            $table->integer('accountable_id');
            $table->string('transactionable_type');
            $table->integer('transactionable_id');
            $table->unsignedInteger('account_code')->nullable();
            $table->unsignedInteger('reference_number')->nullable();
            $table->decimal('amount',14,2);
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
        Schema::dropIfExists('subsidiary_ledgers');
    }
}
