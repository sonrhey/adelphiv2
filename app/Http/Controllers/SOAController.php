<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Client;
use App\Account;
use App\LoanPaymentHistory;
use App\PaymentType;
use App\ChequeManagement;
use App\ChequeHistory;
use App\AmmortizationSchedule;

class SOAController extends Controller
{
    public function index(){
        return view('pages.soa.index');
    }

    public function getclient(){
        $client = Client::all();
        return response()->json($client, 200);
    }

    public function getaccounts(Request $request){
        $account = Account::where('client_id', $request->client_id)->get();
        return response()->json($account, 200);
    }

    public function generatesoa(Request $request){
        $client_id = $request->client_id;
        $account_number = $request->account_number;
        $client = Client::find($client_id);
        $account = Account::find($account_number);
        $ammortization = AmmortizationSchedule::where('account_id', $account_number)->get();
        $html = '';
        $html .= '
            <style>
            table{
                width: 100%;
            }
            table, tr, td, th {
                vertical-align: middle !important;
            }
            .soa-table{
                border: none !important;
            }
            h2{
                text-align: center;
            }
            .client-details{
                display: flex;
            }
            .client-details div{
                width: 100%;
            }
            .hr{
                text-decoration: underline;
            }
            </style>
            ';
        $html .= '
            <table class="soa-table"><tr style="text-align: center"><td colspan="9"><center><h2>STATEMENT OF ACCOUNT</h2></center></td></tr></table>
            <div>
                <table>
                    <tr></tr>
                    <tr>
                        <td><label>Client Name:</label></td>
                        <td><b>'.$client->first_name.', '.$client->last_name.'</b></td>
                        <td></td>
                        <td><label>Title #: </label></td>
                        <td><b>'.$account->property_collateral->first()->title_number.'</b></td>
                        <td></td>
                        <td><label>Size:  </label></td>
                        <td><b>'.$account->property_collateral->first()->lot_area.'</b></td>
                    </tr>
                    <tr>
                        <td><label>Date Released:</label></td>
                        <td><b>'.$account->updated_at.'</b></td>
                        <td></td>
                        <td><label>Tax dec #:</label></td>
                        <td> <b>'.$account->property_collateral->first()->tax_declaration_number.'</b></td>
                        <td></td>
                        <td><label>Location:  </label></td>
                        <td><b>'.$account->property_collateral->first()->property_address.'</b></td>
                    </tr>
                    <tr>
                        <td><label>Account #: </label></td>
                        <td><b>'.$account->account_number.'</b></td>
                        <td></td>
                        <td><label>Principal Amount: </label></td>
                        <td><b>'.$account->approved_loan_amount.'</b></td>
                        <td></td>
                        <td><label>Loan Type:</label></td>
                        <td> <b>'.$account->loan_type->name.'</b></td>
                    </tr>
                </table>
            </div>
        ';
        $html .= '
            <table class="table table-bordered">
                <tr></tr>
                <tr></tr>
                <thead>
                    <th><b>Payment Date</b></th>
                    <th><b>Check Date</b></th>
                    <th><b>Check Num</b></th>
                    <th><b>Check Amnt</b></th>
                    <th><b>Transaction Date</b></th>
                    <th><b>Amount Paid</b></th>
                    <th><b>Penalty</b></th>
                    <th><b>Compounded</b></th>
                    <th><b>Balance</b></th>
                </thead>
        ';
        foreach($ammortization as $ammort){
            $loanpaymenthistory = LoanPaymentHistory::where('ammortization_id', $ammort->id)->get();
            $rowspan = count($loanpaymenthistory);
            if($rowspan > 1){
                $rowspan += 1;
                $html .= '<tr><td rowspan="'.$rowspan.'">'.$ammort->due_date.'</td></tr>';
                foreach($loanpaymenthistory as $lph){
                        $transaction_date = date('Y/m/d', strtotime($lph->created_at));
                        $amount_paid = number_format($lph->amount_paid, 2, '.', ',');
                        $balance = number_format($lph->current_amount, 2, '.', ',');
                        $payment_type = PaymentType::find($lph->payment_type_id);
                        $cheque_amount = 'N/A';
                        $cheque_date = 'N/A';
                        $cheque_num = 'N/A';
                        if($payment_type->name == "Cheque"){
                            $cheque_history = ChequeHistory::where('loan_schedule_id', $lph->ammortization_id)->first();
                            $cheque_management = ChequeManagement::find($cheque_history->cheque_id)->first();
                            $cheque_amount = number_format($lph->amount_paid, 2, '.', ',');
                            $cheque_date = date('Y/m/d', strtotime($cheque_management->cheque_expiry_date));
                            $cheque_num = $cheque_management->cheque_name;
                        }

                        $html .= '
                            <tr>
                            <td>'.$cheque_date.'</td>
                            <td>'.$cheque_num.'</td>
                            <td>'.$cheque_amount.'</td>
                            <td>'.$transaction_date.'</td>
                            <td>'.$amount_paid.'</td>
                            <td>N/A</td>
                            <td>N/A</td>
                            <td>'.$balance.'</td>
                            </tr>
                        ';
                }
            }

            if($rowspan == 1){
                $html .= '<tr><td>'.$ammort->due_date.'</td>';
                $lph = $loanpaymenthistory->first();
                $transaction_date = date('Y/m/d', strtotime($lph["created_at"]));
                $amount_paid = number_format($lph["amount_paid"], 2, '.', ',');
                $balance = number_format($lph["current_amount"], 2, '.', ',');
                $payment_type = PaymentType::find($lph["payment_type_id"]);
                $cheque_amount = 0;
                $cheque_date = 'N/A';
                $cheque_num = 'N/A';
                if($payment_type->name == "Cheque"){
                    $cheque_amount = number_format($lph["amount_paid"], 2, '.', ',');
                    $cheque_history = ChequeHistory::where('loan_schedule_id', $lph["ammortization_id"])->first();
                    $cheque_management = ChequeManagement::find($cheque_history->cheque_id)->first();
                    $cheque_amount = number_format($lph->amount_paid, 2, '.', ',');
                    $cheque_date = date('Y/m/d', strtotime($cheque_management->cheque_expiry_date));
                    $cheque_num = $cheque_management->cheque_name;
                }

                $html .= '
                    <td>'.$cheque_date.'</td>
                    <td>'.$cheque_num.'</td>
                    <td>'.$cheque_amount.'</td>
                    <td>'.$transaction_date.'</td>
                    <td>'.$amount_paid.'</td>
                    <td>N/A</td>
                    <td>N/A</td>
                    <td>'.$balance.'</td>
                    </tr>
                ';
            }
        }
        $html .= '</table>';
        return $html;
    }
    //
}
