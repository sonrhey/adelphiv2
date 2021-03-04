<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientFamiliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_family', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name');
            $table->string('middle_name');
            $table->string('last_name');
            $table->string('suffix')->nullable();
            $table->integer('client_relation_id');  
            $table->date('birth_date');
            $table->integer('civil_status_id');
            $table->string('gender');
            $table->integer('nationality_id');
            $table->string('email_address');
            $table->string('mobile_number');         
            $table->string('landline_number');
            $table->string('address_1');
            $table->integer('city1_id');
            $table->integer('barangay1_id');
            $table->string('length_stay_1');         
            $table->string('address_2');
            $table->integer('city2_id');
            $table->integer('barangay2_id');
            $table->string('length_stay_2');         
            $table->string('status');
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
        Schema::dropIfExists('client_family');
    }
}
