<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePropertyCollateralsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('property_collateral', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('account_id');
            $table->string('name_registered');
            $table->integer('city_id');
            $table->integer('barangay_id');
            $table->string('property_address');
            $table->integer('title_number');
            $table->integer('tax_declaration_number');
            $table->decimal('lot_area',28,2);
            $table->integer('unit_measure_id');
            $table->integer('property_type_id');
            $table->date('date_acquired');
            $table->string('acquisition_type');
            $table->decimal('acquisition_price',28,2);
            $table->decimal('current_value',28,2);
            $table->integer('attachment_id')->nullable();
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
        Schema::dropIfExists('property_collateral');
    }
}
