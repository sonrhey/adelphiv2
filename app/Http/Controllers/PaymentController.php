<?php

namespace App\Http\Controllers;
use App\Account;
use App\AmmortizationSchedule;
use App\ChequeManagement;
use App\ChequeHistory;
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
        $account = Account::find($id);
        $view = ($account->account_status_id == 4) ? 'view' : 'edit' ;
        return view('pages.payment.'.$view.'', compact('account'));
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
        $account = AmmortizationSchedule::where('account_id', $id)->with('ammortization_status');
        return DataTables::of($account)
        ->addColumn('action', function ($c){
            $controls = "";
            if($c->balance > 0){
                $cheques = $c->account->client->cheque->where('cheque_value', '>', 0);
                $select = "";
                foreach($cheques as $chq){
                    $select .= "
                    <option data-cheque-id=".$chq->id." data-payment-id=".$c->id." value=".$chq->cheque_value.">".$chq->cheque_name."</option>
                    ";
                }
                $controls = '<div class="row" style="margin: auto;"><div class="col-xs-12" style="width: 100%"><select class="form-control selectpicker" data-live-search="true" data-style="btn-user btn-bordered" name="bank_id" required><option selected disabled>Select a Cheque</option>'.$select.'
                </select></div><div class="col-xs-12 mt-2"><form id="payloannow"><div class="row"><div class="col-sm-9" style="padding-right: 0; max-width: 68%"><input type="text" class="form-control payment-input" data-loan-schedule-id="'.$c->id.'" id="payment'.$c->id.'" required></div><div class="col-sm-3" style="padding-right: 0;"><button class="btn btn-primary" type="submit">Pay</button></div></div></form></div></div>';
            }

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
            $payment = $request->paymentValue - $ammort->due_ammount;

            if($payment < 0){
                $balance = (-1) * $payment;
                $ammort->balance = $balance;
                $ammort->ammortization_schedule_status_id = 4;
                $ammort->save();

                $cheque = ChequeManagement::find($request->chequeId);
                $cheque->cheque_value = 0;
                $cheque->save();

                $cheque_history = $this->chequeHistory($request->chequeId, $request->paymentValue, $id, $loanScheduleId, 0);
            }else{
                $ammort->balance = 0;
                $ammort->ammortization_schedule_status_id = 2;
                $ammort->save();

                $cheque = ChequeManagement::find($request->chequeId);
                $cheque->cheque_value = $payment;
                $cheque->save();

                $cheque_history = $this->chequeHistory($request->chequeId, $ammort->due_ammount, $id, $loanScheduleId, $payment);
            }

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
            return $ex;
        }
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
}
