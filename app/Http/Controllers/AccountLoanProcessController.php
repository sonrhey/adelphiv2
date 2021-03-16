<?php

namespace App\Http\Controllers;

use App\AccountLoanProcess;
use App\Account;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\AmmortizationSchedule;
use App\LoanAmount;
use DB;

class AccountLoanProcessController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.loanprocess.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        dd('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        dd($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        dd($id);
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
        dd('dfsss');
        //
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
        dd($request->all());
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

    public function updatestatus(Request $request, $id){
            DB::beginTransaction();
        try{
            $updatestatus = AccountLoanProcess::find($request->acctlpid);
            $updatestatus->status = 2;
            $updatestatus->save();
    
            $account_id = $updatestatus->account_id;
            $account = Account::find($account_id);

            $getnext = AccountLoanProcess::where('id', '>', $updatestatus->id)->orderBy('id')->first();
    
            if($getnext){
                $updatenext = AccountLoanProcess::find($getnext->id);
                $updatenext->status = 1;
                $updatenext->save();
            }
            if($getnext->loan_process_id == 3){
                $loan_amount = LoanAmount::find($account->loan_amount_id);
                $loan_type = $account->loan_type_id;
                if($loan_type == 1){
                    $ammortization = $this->calculateammortization($account->account_number);
                }else if($loan_type == 2){
                    $ammortization = $this->calculateammortization_interestonly($account->account_number);
                }
            }
            $account->loan_process_status_id = $getnext->loan_process_id;
            $account->save();
            
            DB::commit();
            return redirect()->back();
        }catch(\Exception $ex){
            DB::rollback();
            return redirect()->back();
        }
    }

        private function calculateammortization_interestonly($accountnumber){
        $getloanamount = Account::where('account_number', $accountnumber)->first();
        $loan_amount = LoanAmount::find($getloanamount->loan_amount_id);
        $principal = $loan_amount->amount;
        $interest = (double)$principal * 0.03;

        $to_pay = 18;
        $i=0;

        while($i<$to_pay){
            $i++;
            $date = Carbon::now();
            $due_date = $this->get_monthly_dates($date, $i);

            $save_ammort = $this->save_ammortization($getloanamount->id, $due_date, $interest, $interest, $principal);
        }
    }

    private function calculateammortization($accountnumber){
        $getloanamount = Account::where('account_number', $accountnumber)->first();
        $loan_amount = LoanAmount::find($getloanamount->loan_amount_id);
        $approvedamount = $loan_amount->amount;
        $to_pay = 18;
        $every18th = (double)$approvedamount / $to_pay; //6,111.11

        $amount = $approvedamount;
        $deduction = 0;
        $i=0;

        while($i<$to_pay){
            $i++;
            $date = Carbon::now();
            $monthly_dates = $this->get_monthly_dates($date, $i);
            if($i<=6){
                $monthly_payment = $this->get_monthly($amount, $every18th);
            }else{
                $deduction = $this->get_latest_amount($amount, $every18th);
                $monthly_payment = $this->get_monthly($deduction, $every18th);
                if($i%6 == 0){
                    $amount = $deduction;
                }
            }
            $deduction = ($deduction == 0) ? $amount : $deduction;    
            
            $ammortization = $this->save_ammortization($getloanamount->id, $monthly_dates, $monthly_payment[0], $monthly_payment[1], $approvedamount);
        }
    }

    private function get_monthly($amount, $every18th)
    {
        $get2per = $amount * 0.02;
        $get6payment = $every18th + $get2per;

        return [$get6payment, $get2per];
    }

    private function get_latest_amount($amount, $every18th){
        $succeedingmonth = (double)$every18th * 6;
        $deduction = $amount - $succeedingmonth;

        return $deduction;
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
            $ammortization->account_status_id = 5;
            $ammortization->save();
        }catch(\Exception $ex){
            throw $ex;
        }
    }

    public function payment_schedule($id){
        $amschedule = AmmortizationSchedule::where('account_id', $id)->get();
        return view('pages.accounts.payment_schedule.index', compact('amschedule'));
    }
}
