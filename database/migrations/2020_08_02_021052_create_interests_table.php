<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInterestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('interests', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('account_id');
            $table->date('due_date');
            $table->decimal('due_ammount');
            $table->decimal('interest');
            $table->decimal('balance');
            $table->decimal('penalty', 18, 2)->default(0);
            $table->integer('days_due')->default(0);
            $table->integer('ammortization_schedule_status_id');
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
        Schema::dropIfExists('interests');
    }
}
