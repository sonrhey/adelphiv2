<?php

use App\ChargesDetails;
use Illuminate\Database\Seeder;

class DeductionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ChargesDetails::insert([
        	[
        		'loan_amount_id' => '1',
        		'commission_amount' => '100',
        		'service_fee_amount' => '100',
        		'total_handling_fee' => '300',
        		'promi_note' => '100',
        		'spa' => '100',
        		'rem' => '100',
        		'total_notarial' => '200',
        		'appraisal' => '100',
        		'chart_fee' => '100',
        		'formulated_fee' => '100',
        		'fixed_amount' => '100',
        		'legal_fee' => '100',
        		'total_annotation' => '1400',
        		'document_stamp' => '100',
        		'relocation_fee' => '100',
        		'insurance' => '100',
        		'taxes' => '100',
        		'total_deductions' => '2400',
        		'net_proceeds' => '107600',
        		'location_deduction_id' => '1'
        	]
        ]);
    }
}
