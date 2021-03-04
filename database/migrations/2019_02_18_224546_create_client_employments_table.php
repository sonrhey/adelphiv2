<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientEmploymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_employment', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('client_id');
            $table->string('company_name');
            $table->string('position');
            $table->string('length_stay');
            $table->string('address');
            $table->integer('city_id');
            $table->integer('barangay_id');
            $table->string('email');
            $table->string('contact_number');
            $table->string('mobile_number');
            $table->decimal('monthly_income');
            $table->integer('employment_status_id');
            $table->integer('industry_id');
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
        Schema::dropIfExists('client_employment');
    }
}
