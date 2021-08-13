<?php

namespace App\Http\Controllers;
use App\Account;
use App\AmmortizationSchedule;
use App\ChequeManagement;
use App\ChequeHistory;
use App\PaymentType;
use App\LoanPaymentHistory;
use App\CashManagement;
use App\CashHistory;

use Yajra\DataTables\Facades\Datatables;
use Illuminate\Http\Request;
use DB;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.payment.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try{
            $account = Account::find($id);
            $view = ($account->account_status_id == 4) ? 'view' : 'edit' ;
            return view('pages.payment.'.$view.'', compact('account'));
        }catch(\Exception $ex){
            abort(500);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function payment_schedules($id){
        $account = AmmortizationSchedule::where('account_id', $id);
        return DataTables::of($account)
        ->editColumn('ammortization_status', function($c){
            return $c->ammortization_status->name;
        })
        ->addColumn('action', function ($c){
            $payment_types = PaymentType::all();
            $controls = "";
            $payment_type_select = "";
            $cheque = "";
            $cash = "";
            if($c->balance > 0){
                $payment_type_options = "";
                foreach($payment_types as $payment_type){
                    $payment_type_options .= '
                        <option data-ammortization-id="'.$c->id.'" value="'.$payment_type->code.'">'.$payment_type->name.'</option>
                    ';
                }
                $payment_type_select = '<div class="mb-2"><select class="form-control selectpicker" data-live-search="true" data-style="btn-user btn-bordered" name="payment_type"><option selected disabled>Select Payment Type</option>'.$payment_type_options.'</select></div>';
                $cheques = $c->account->client->cheque->where('cheque_value', '>', 0);
                $select = "";
                foreach($cheques as $chq){
                    $select .= "
                    <option data-cheque-id=".$chq->id." data-payment-id=".$c->id." value=".$chq->cheque_value.">".$chq->cheque_name."</option>
                    ";
                }

                $cash = $c->account->client->cash->first();
                $cash = '<div class="cash-display'.$c->id.'" style="display: none"><form class="payloannow"><input type="number" step="any" class="form-control payment-input" data-loan-schedule-id="'.$c->id.'" data-cash-id="'.@$cash->id.'" value="'.@$cash->amount.'"><div class="mb-2"></div><button class="btn btn-primary btn-block" type="submit">Pay</button></form></div>';
                
                $cheque = '<div class="row cheque-display'.$c->id.'" style="margin: auto; display: none;"><div class="col-xs-12" style="width: 100%"><select class="form-control selectpicker" data-live-search="true" data-style="btn-user btn-bordered" name="bank_id" required><option selected disabled>Select a Cheque</option>'.$select.'
                </select></div><div class="col-xs-12 mt-2"><form class="payloannow"><div class="row"><div class="col-sm-9" style="padding-right: 0; max-width: 60%"><input type="text" class="form-control payment-input" data-loan-schedule-id="'.$c->id.'" id="payment'.$c->id.'" required></div><div class="col-sm-3" style="padding-right: 0;"><button class="btn btn-primary" type="submit">Pay</button></div></div></form></div></div>';

                $controls = '<div>'.$payment_type_select.'<div class="payment_inputs">'.$cheque.''.$cash.'</div></div>';
            }

            // return $controls;
            return $controls;
        })
        ->make(true);
    }

    public function payment_loan($id, Request $request){
        DB::beginTransaction();
        try{
            $loanScheduleId = $request->loanScheduleId;
            $ammort = AmmortizationSchedule::find($loanScheduleId);
            $loanType = Account::find($ammort->account_id);
            $loanTypeName = $loanType->loan_type->name;
            $payment = $ammort->balance - $request->paymentValue;
            $remainingBalance = 0;
            $chequeRemainingBalance = 0;
            $amount = 0;
            $previousAmt = $ammort->balance;

            if($payment <= 0){
                $chequeRemainingBalance = (-1) * $payment;
                $ammort->balance = 0;
                $ammort->ammortization_schedule_status_id = 2;
                $ammort->save();

                $remainingBalance = 0;
                $amount = $previousAmt;
            }else{
                $chequeRemainingBalance = 0;
                $ammort->balance = $payment;
                $ammort->ammortization_schedule_status_id = 4;
                $ammort->save();

                $remainingBalance = $payment;
                $amount = $request->paymentValue;
            }

            if($request->paymentType === "CHQ"){
                $cheque = ChequeManagement::find($request->chequeId);
                $cheque->cheque_value = $chequeRemainingBalance;
                $cheque->save();
                $cheque_history = $this->chequeHistory($request->chequeId, $amount, $id, $loanScheduleId, $chequeRemainingBalance);
            }else if($request->paymentType === "CSH"){
                $cash = CashManagement::updateOrCreate(['id' => $request->cashId], 
                [
                'client_id' => $loanType->client_id,
                'amount' => $chequeRemainingBalance
                ]);
                $cash_history = $this->cashHistory($cash->id, $amount, $id, $loanScheduleId, $chequeRemainingBalance, $request->paymentValue);
            }

            $loanPaymentDetails = [
                "account_id" => $id,
                "ammortization_id" => $ammort->id,
                "previous_amount" => $previousAmt,
                "current_amount" => $remainingBalance,
                "deducted_amount" => $amount,
                "payment_type_code" => $request->paymentType,
                "amount_paid" => $request->paymentValue
            ];

            $loanPaymentHistory = $this->loanPaymentHistory($loanPaymentDetails);

            $checkAccount = AmmortizationSchedule::where('account_id', $id)->where('balance', '>', 0)->count();

            if($checkAccount == 0){
                $account = Account::find($id);
                $account->account_status_id = 4;
                $account->save();
            }

            DB::commit();
            return redirect()->back();
        }catch(\Exception $ex){
            DB::rollback();
            dd($ex);
        }
    }

    private function loanPaymentHistory($loanPaymentDetails){
        $payment_code = $loanPaymentDetails["payment_type_code"];
        $payment_code_id = PaymentType::where('code', $payment_code)->first();

        $loan_payment_history = new LoanPaymentHistory();
        $loan_payment_history->account_id  = $loanPaymentDetails["account_id"];
        $loan_payment_history->ammortization_id  = $loanPaymentDetails["ammortization_id"];
        $loan_payment_history->previous_amount  = $loanPaymentDetails["previous_amount"];
        $loan_payment_history->current_amount  = $loanPaymentDetails["current_amount"];
        $loan_payment_history->deducted_amount  = $loanPaymentDetails["deducted_amount"];
        $loan_payment_history->payment_type_id = $payment_code_id->id;
        $loan_payment_history->amount_paid = $loanPaymentDetails["amount_paid"];
        $loan_payment_history->save();
    }

    private function chequeHistory($chequeId, $paymentValue, $accountId, $loanScheduleId, $remainingBalance){
        $cheque_history = new ChequeHistory();
        $cheque_history->cheque_id = $chequeId;
        $cheque_history->account_id = $accountId;
        $cheque_history->loan_schedule_id = $loanScheduleId;
        $cheque_history->deducted_amount = $paymentValue;
        $cheque_history->remaining_balance = $remainingBalance;
        $cheque_history->save();
    }

    private function cashHistory($chequeId, $paymentValue, $accountId, $loanScheduleId, $remainingBalance, $amount_paid){
        $cash_history = new CashHistory();
        $cash_history->cash_id = $chequeId;
        $cash_history->account_id = $accountId;
        $cash_history->loan_schedule_id = $loanScheduleId;
        $cash_history->deducted_amount = $paymentValue;
        $cash_history->remaining_balance = $remainingBalance;
        $cash_history->amount_paid = $amount_paid;
        $cash_history->save();
    }

    private function payment_status($due_amount, $payment, $balance){
        if($balance == 0){
            $status_id = 2;
        }else if($payment < $due_amount){
            if($balance == $due_amount){
                $status_id = 1;
            }else{
                $status_id = 4;
            }
        }

        return $status_id;
    }

    private function check_if_fully_paid($id){
        $amtsched = AmmortizationSchedule::where('account_id', $id)
        ->whereIn('ammortization_schedule_status_id', array('1', '3', '4'))
        ->count();
        if($amtsched == 0){
            $account = Account::find($id);
            $account->account_status_id = 4;
            $account->save();
        }

        return $amtsched;
    }

    private function calculateammortization_interestonly($accountnumber,$principal){
        $getloanamount = Account::where('account_number', $accountnumber)->first();
        $interest = (double)$principal * 0.03;

        $to_pay = 6;
        $i=0;

        while($i<$to_pay){
            $i++;
            $date = Carbon::now();
            $due_date = $this->get_monthly_dates($date, $i);

            $save_ammort = $this->save_ammortization($getloanamount->id, $due_date, $interest, $interest, $principal);
        }
    }

    private function get_monthly_dates($date, $i){
        $increment_by_1 = strtotime("+".$i." months", strtotime($date));
        $monthly_dates = date('Y-m-d',$increment_by_1);

        return $monthly_dates;
    }

    private function save_ammortization($accountid, $due_date, $due_amount, $interest, $principal){
        try{
            $ammortization = new AmmortizationSchedule();
            $ammortization->account_id = $accountid;
            $ammortization->due_date = $due_date;
            $ammortization->due_ammount = $due_amount;
            $ammortization->interest = $interest;
            $ammortization->principal = $principal;
            $ammortization->balance = $due_amount;
            $ammortization->ammortization_schedule_status_id = 1;
            $ammortization->save();
        }catch(\Exception $ex){
            throw $e;
        }
    }

}
