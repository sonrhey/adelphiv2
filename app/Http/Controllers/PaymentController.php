<?php

namespace App\Http\Controllers;
use App\Account;
use App\AmmortizationSchedule;
use Yajra\DataTables\Facades\Datatables;
use Illuminate\Http\Request;

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
            if($c->balance == 0){
                return '<input type="text" class="form-control payment-input" data-loan-schedule-id="'.$c->id.'" id="payment'.$c->id.'" value="'.$c->due_ammount.'" readonly>';
            }else{
                return '<input type="text" class="form-control payment-input" data-loan-schedule-id="'.$c->id.'" id="payment'.$c->id.'">';
            }
            
        })
        ->make(true);
    }

    public function payment_loan($id, Request $request){
        $paymentdetails = $request->payment_details;
        $payments = json_decode($paymentdetails);
        // return count($decode);
        foreach($payments as $pmts){
            $payment_id = $pmts->payment_id;
            $balance = $pmts->balance;
            $due_amount = $pmts->due_amount;
            $payment = $pmts->payment;
            $status = $this->payment_status($due_amount, $payment, $balance);

            $amtsched = AmmortizationSchedule::where([
                'id' => $payment_id,
                'account_id' => $id
            ])->update([
                'balance' => $balance,
                'ammortization_schedule_status_id' => $status
            ]);
        }

        $check = $this->check_if_fully_paid($id);
        return 'Payment Success!';
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
