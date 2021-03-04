<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountCheckListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('account_checklist', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('account_id');
            $table->integer('check_number');
            $table->date('check_date');
            $table->decimal('check_ammount');
            $table->integer('bank_id');
            $table->integer('account_checklist_status_id');
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
        Schema::dropIfExists('account_checklist');
    }
}
