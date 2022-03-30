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
use App\LoanCycle;
use App\LoanAmount;
use App\LoanTracker;

use Yajra\DataTables\Facades\Datatables;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;

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
            $view_name = "";
            if($account->account_status_id == 4 || $account->account_status_id == 7){
                $view_name = 'view';
            }else{
                $view_name = 'edit';
            }
            return view('pages.payment.'.$view_name.'', compact('account'));
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
        ->editColumn('due_ammount', function($c){
            return number_format($c->due_ammount, 2, '.', ',');
        })
        ->editColumn('balance', function($c){
            return number_format($c->balance, 2, '.', ',');
        })
        ->editColumn('penalty', function($c){
            return number_format($c->penalty, 2, '.', ',');
        })
        ->addColumn('action', function ($c){
            $payment_types = PaymentType::all();
            $controls = "";
            $payment_type_select = "";
            $cheque = "";
            $cash = "";
            if($c->account->account_status_id != 7 && $c->account->account_status_id != 4){
                if($c->balance > 0){
                    $payment_type_options = "";
                    foreach($payment_types as $payment_type){
                        $payment_type_options .= '
                            <option data-ammortization-id="'.$c->id.'" value="'.$payment_type->code.'">'.$payment_type->name.'</option>
                        ';
                    }
                    $payment_type_select = '<div class="mb-2"><select class="form-control selectpicker" data-live-search="true" data-style="btn-user btn-bordered" name="payment_type" style="display: block !important"><option selected disabled>Select Payment Type</option>'.$payment_type_options.'</select></div>';
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
            $loan_cycle = 0;
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
                $check_loan_cycle = LoanCycle::where('account_id', $account->id)->orderBy('id', 'DESC')->first();
                $loan_cycle = $check_loan_cycle->cycle_count;
                if($check_loan_cycle->cycle_count == 3){
                    $account->account_status_id = 4;
                    $account->save();
                }
            }

            DB::commit();
            return response()->json([
                "loan_cycle" => $loan_cycle
            ], 200);
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

    private function calculateammortization($accountnumber){
        try{
            DB::beginTransaction();
            $account = Account::where('account_number', $accountnumber)->first();
            $loan_cycle = LoanCycle::where('account_id', $account->id)->orderBy('id', 'DESC')->first();
            $loan_tracker = LoanTracker::where('account_id', $account->id)->first();
            $i = 0;
            $date_counter = 0;
            $approvedamount = 0;
            $month_payment_cycle = 1;
            $month_cycle = 6;
            $loan_term = 18;
            $interest = 0.02;

            //check if loan tracker table
            if($loan_tracker == null){
                $date_counter = 0;
            }else{
                $date_counter = $loan_tracker->cycle_counter;
                $month_payment_cycle = $month_payment_cycle + $loan_tracker->month_cycle;
                $month_cycle = $month_cycle + $loan_tracker->cycle_counter;
            }

            //check if loan tracker table
            if($loan_cycle == null){
                $approvedamount = $account->approved_loan_amount;
            }else{
                $loan_cycle_amount = $loan_cycle->amount;
                $approvedamount = $loan_cycle_amount - $loan_cycle->total_cycle_payment;
            }

            //get basic calculation
            $withoutInterest = (double)$account->approved_loan_amount / $loan_term;
            $interest_value = (double)$approvedamount * $interest;
            $monthly_payment = $withoutInterest + $interest_value;
            $total_cycle_payment = $withoutInterest * 6;
            $i = $date_counter;
            //loop through months
            while($i<$month_cycle){
                $i++;
                $date = Carbon::now();
                $monthly_dates = $this->get_monthly_dates($date, $i); 
                $ammortization = $this->save_ammortization($account->id, $monthly_dates, $monthly_payment, $interest_value, $approvedamount);
            }

            //loan tracker
            $loan_tracker_insertOrUpdate = LoanTracker::firstOrNew(['account_id' => $account->id]);
            $loan_tracker_insertOrUpdate->account_id = $account->id;
            $loan_tracker_insertOrUpdate->month_cycle = $month_payment_cycle;
            $loan_tracker_insertOrUpdate->cycle_counter = $i;
            $loan_tracker_insertOrUpdate->save(); 

            //loan cycle
            $loan_cycle_insert = new LoanCycle();
            $loan_cycle_insert->account_id = $account->id;
            $loan_cycle_insert->amount = $approvedamount;
            $loan_cycle_insert->cycle_count = $month_payment_cycle;
            $loan_cycle_insert->total_cycle_payment = $total_cycle_payment;
            $loan_cycle_insert->cycle_status = 'ONGOING';
            $loan_cycle_insert->save();

            DB::commit();
        }catch(\Exception $ex){
            DB::rollback();
            dd($ex);
        }
    }

    private function calculateammortization_interestonly($accountnumber){
        try{
            DB::beginTransaction();
            $account = Account::where('account_number', $accountnumber)->first();
            $loan_cycle = LoanCycle::where('account_id', $account->id)->orderBy('id', 'DESC')->first();
            $loan_tracker = LoanTracker::where('account_id', $account->id)->first();
            $i = 0;
            $date_counter = 0;
            $approvedamount = 0;
            $month_payment_cycle = 1;
            $month_cycle = 4;
            $loan_term = 12;
            $interest = 0.03;

            //check if loan tracker table
            if($loan_tracker == null){
                $date_counter = 0;
            }else{
                $date_counter = $loan_tracker->cycle_counter;
                $month_payment_cycle = $month_payment_cycle + $loan_tracker->month_cycle;
                $month_cycle = $month_cycle + $loan_tracker->cycle_counter;
            }

            //check if loan tracker table
            if($loan_cycle == null){
                $approvedamount = $account->approved_loan_amount;
            }else{
                $loan_cycle_amount = $loan_cycle->amount;
                $approvedamount = $loan_cycle_amount - $loan_cycle->total_cycle_payment;
            }

            //get basic calculation
            // $withoutInterest = (double)$account->approved_loan_amount / $loan_term;
            $interest_value = (double)$approvedamount * $interest;
            // $monthly_payment = $withoutInterest + $interest_value;
            // $total_cycle_payment = $withoutInterest * 6;
            $i = $date_counter;
            //loop through months
            while($i<$month_cycle){
                $i++;
                $date = Carbon::now();
                $monthly_dates = $this->get_monthly_dates($date, $i); 
                $ammortization = $this->save_ammortization($account->id, $monthly_dates, $interest_value, $interest_value, $approvedamount);
            }

            //loan tracker
            $loan_tracker_insertOrUpdate = LoanTracker::firstOrNew(['account_id' => $account->id]);
            $loan_tracker_insertOrUpdate->account_id = $account->id;
            $loan_tracker_insertOrUpdate->month_cycle = $month_payment_cycle;
            $loan_tracker_insertOrUpdate->cycle_counter = $i;
            $loan_tracker_insertOrUpdate->save(); 

            //loan cycle
            $loan_cycle_insert = new LoanCycle();
            $loan_cycle_insert->account_id = $account->id;
            $loan_cycle_insert->amount = $approvedamount;
            $loan_cycle_insert->cycle_count = $month_payment_cycle;
            $loan_cycle_insert->total_cycle_payment = 0;
            $loan_cycle_insert->cycle_status = 'ONGOING';
            $loan_cycle_insert->save();

            DB::commit();
        }catch(\Exception $ex){
            DB::rollback();
            dd($ex);
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

    public function renew($id){
        $account = Account::find($id);
        $check_loan_cycle = LoanCycle::where('account_id', $account->id)->orderBy('id', 'DESC')->first();
        $loan_cycle = $check_loan_cycle->cycle_count;
        if($account->loan_type->name === "Interest Only"){
            $account_ammortization = $this->calculateammortization_interestonly($account->account_number);
        }else if($account->loan_type->name === "Ammortized"){
            $account_ammortization = $this->calculateammortization($account->account_number);
        }

        return redirect()->back();
    }

    public function payout($id, Request $request){
        try{
        $loan_cycle_update = LoanCycle::where('account_id', $id)->orderBy('id', 'DESC')->first();
        $loan_cycle_update_data = LoanCycle::where('id', $loan_cycle_update->id)->update([
            'total_cycle_payment' => $request->payout_amount
        ]);
            return redirect()->back();
        }catch(\Exception $ex){
            dd($ex);
        }
        // $account = Account::find($id);
        // $check_loan_cycle = LoanCycle::where('account_id', $account->id)->orderBy('id', 'DESC')->first();
        // $loan_cycle = $check_loan_cycle->cycle_count;
        // if($account->loan_type->name === "Interest Only"){
        //     $account_ammortization = $this->calculateammortization_interestonly($account->account_number);
        // }else if($account->loan_type->name === "Ammortized"){
        //     $account_ammortization = $this->calculateammortization($account->account_number);
        // }

        // return redirect()->back();
    }

    public function revert($id){
        //get cycle
        try{
        DB::beginTransaction();
        $loan_cycle = LoanCycle::where('account_id', $id)->orderBy('id', 'DESC')->first();
        $loan_cycle_amount = $loan_cycle->amount;
        $total_cycle_payment = $loan_cycle->total_cycle_payment;
        $next_amount = $loan_cycle_amount - $total_cycle_payment;

        $ammortization = AmmortizationSchedule::where('account_id', $id)->select([
            DB::raw('SUM(balance) as balance')
            ])->first();

        $ammort_balance = $ammortization->balance;
        $new_amount = $next_amount + $ammort_balance;

        $loan_amount = LoanAmount::firstOrNew(['amount' => $new_amount]);
        $loan_amount->amount = $new_amount;
        $loan_amount->save(); 

        $account = Account::find($id);
        $account->account_status_id = 7;
        $account->save();

        $reverted_account = new Account($account->toArray());
        $reverted_account->loan_amount = $new_amount;
        $reverted_account->loan_amount_id = $loan_amount->id;
        $reverted_account->approved_loan_amount = $new_amount;
        $reverted_account->approved_load_amount_id = $loan_amount->id;
        $reverted_account->account_status_id = 3;
        $reverted_account->loan_type_id = 2;
        $reverted_account->save();

        $account_number = $this->accountNumber($reverted_account->id, 2);
        $update = Account::find($reverted_account->id);
        $update->account_number = $account_number;
        $update->save();  

        $calculate_ammortization = $this->calculateammortization_interestonly($account_number);

        DB::commit();      

        return redirect('/payment');
        }catch(\Exception $ex){
            DB::rollback();
            dd($ex);
        }
    }

    private function accountNumber($account_id, $loan_type_id){
        if ($loan_type_id == 1) {
            $prefix = 'A';
        }else{
            $prefix = 'I';
        }
        $account_id_length = strlen($account_id);
       if($account_id_length < 10){
        $account_number = $prefix.' - 0000000'.$account_id;
       }elseif ($account_id_length < 100) {
           $account_number = $prefix.' - 000000'.$account_id;
       }elseif ($account_id_length < 1000){
            $account_number = $prefix.' - 00000'.$account_id;
       }elseif ($account_id_length < 10000) {
           $account_number = $prefix.' - 0000'.$account_id;
       }elseif ($account_id_length < 100000) {
           $account_number = $prefix.' - 000'.$account_id;
       }elseif ($account_id_length < 1000000) {
           $account_number = $prefix.' - 00'.$account_id;
       }
       elseif ($account_id_length < 10000000) {
           $account_number = $prefix.' - 0'.$account_id;
       }else{
            $account_number = $prefix.'-'.$account_id;
       }

       
        return $account_number;
    }

}
