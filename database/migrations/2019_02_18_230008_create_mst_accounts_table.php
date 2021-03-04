<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMstAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mst_account', function (Blueprint $table) {
            $table->increments('id');
            $table->string('account_number')->nullable();
            $table->integer('client_id');
            $table->decimal('loan_amount')->nullable();
            $table->integer('loan_amount_id');
            $table->decimal('approved_loan_amount')->nullable();
            $table->integer('approved_load_amount_id')->nullable();
            $table->integer('loan_type_id');
            $table->integer('branch_id');
            $table->integer('account_status_id');
            $table->integer('added_by');
            $table->integer('updated_by')->nullable();
            $table->integer('reviewed_by')->nullable();
            $table->integer('appraised_by')->nullable();
            $table->integer('approved_by')->nullable();
            $table->integer('released_by')->nullable();
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
        Schema::dropIfExists('mst_account');
    }
}
