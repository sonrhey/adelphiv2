<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChargesDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('charges_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('loan_amount_id');
            $table->decimal('commission_amount',20,2);
            $table->decimal('service_fee_amount',20,2);
            $table->decimal('total_handling_fee',20,2);
            $table->decimal('promi_note',20,2);
            $table->decimal('spa',20,2);
            $table->decimal('rem',20,2);
            $table->decimal('total_notarial',20,2);
            $table->decimal('appraisal',20,2);
            $table->decimal('chart_fee',20,2);
            $table->decimal('formulated_fee',20,2);
            $table->decimal('fixed_amount',20,2);
            $table->decimal('legal_fee',20,2);
            $table->decimal('total_annotation',20,2);
            $table->decimal('document_stamp',20,2);
            $table->decimal('relocation_fee',20,2);
            $table->decimal('insurance',20,2)->nullable();
            $table->decimal('taxes',20,2)->nullable();
            $table->decimal('total_deductions',20,2);
            $table->decimal('net_proceeds',20,2);
            $table->integer('location_deduction_id');
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
        Schema::dropIfExists('charges_details');
    }
}
