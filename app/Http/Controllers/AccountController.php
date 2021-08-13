<?php

namespace App\Http\Controllers;

use App\Account;
use App\AccountIdentification;
use App\AccountLoanProcess;
use App\AccountStatus;
use App\Branch;
use App\Client;
use App\IdentificationList;
use App\LoanAmount;
use App\LoanProcess;
use App\LoanType;
use App\PropertyCollateral;
use Carbon\Carbon;
use App\AmmortizationSchedule;
use Auth;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\Datatables;
class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.accounts.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $number = $this->accountNumber();
        // $check = Account::where('account_number', $check);
        // if (is_null($check)) {
        //      return view('pages.accounts.create', compact('number'));
        // }else{
        //     $number = $this->accountNumber();
            
        // }
        $clients = Client::all();
        $amounts = LoanAmount::all();
        $loan_types = LoanType::all();
        $branches = Branch::all();
        $statuses = AccountStatus::all();
        return view('pages.accounts.create', compact('clients', 'amounts', 'loan_types', 'branches', 'statuses'));
       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $account = new Account($request->all());
        $account->added_by = Auth::user()->id;
        $account->account_number = 11;
        $account->account_status_id = 1;
        $account->save();
        $account_number = $this->accountNumber($account->id, $request->loan_type_id);
        $update = Account::find($account->id);
        $update->account_number = $account_number;
        $update->save();
        return redirect('accounts/'.$account->id.'/edit')->with('message', 'New account successfully added.');
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
        $view_name = ($account->account_status_id == 3 || $account->account_status_id == 4) ? 'view' : 'edit' ;
        $clients = Client::all();
        $amounts = LoanAmount::all();
        $loan_types = LoanType::all();
        $branches = Branch::all();
        $statuses = AccountStatus::all();
        $identificationlist = IdentificationList::all();
        $process = $this->onProcess($id);
        $acctloanprocess = AccountLoanProcess::where('account_id', $id)->with('loanprocess')->get();
        return view('pages.accounts.'.$view_name.'', compact('account', 'clients', 'amounts', 'loan_types', 'branches', 'statuses', 'identificationlist', 'process', 'acctloanprocess'));
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
        try{
        $loan_amount = LoanAmount::find($request->loan_amount_id);
        $appr_loan_amount = ($request->approved_load_amount_id == null ) ? NULL : LoanAmount::find($request->approved_load_amount_id) ;
        $account = Account::find($id);
        $account->updated_by = Auth::user()->id;
        $account->approved_by = Auth::user()->id;
        $account->loan_amount = $loan_amount->amount;
        $account->approved_loan_amount = ($appr_loan_amount == null) ? null : $appr_loan_amount->amount ;
        $account->fill($request->all());
        $account->save();

        if($request->account_status_id == 3){
            if($request->loan_type_id == 1){
                $ammortization = $this->calculateammortization($account->account_number);
                return redirect('accounts/'.$id.'/accountloanprocess/payment-schedule');
            }else if($request->loan_type_id == 2){
                $ammortization = $this->calculateammortization_interestonly($account->account_number);
                return redirect('accounts/'.$id.'/accountloanprocess/payment-schedule');
            }
        }

        return redirect('accounts/'.$id.'/edit')->with('message', 'New account successfully added.');
        }catch(\Exception $ex){
            abort(500, 'Please check your inputs');
        }
    }

    private function calculateammortization_interestonly($accountnumber){
        $getloanamount = Account::where('account_number', $accountnumber)->first();
        $principal = $getloanamount->approved_loan_amount;
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

    private function calculateammortization($accountnumber){
        $getloanamount = Account::where('account_number', $accountnumber)->first();
        $approvedamount = $getloanamount->approved_loan_amount;
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
            $ammortization->save();
        }catch(\Exception $ex){
            throw $e;
        }
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
    public function getAccounts(){
        $accounts = Account::select('mst_account.id', 'lt.name as type', 'mst_account.account_number', 'c.first_name', 'c.middle_name', 'c.last_name', 'b.name', 'st.name as status')->leftjoin('clients as c', 'mst_account.client_id', '=', 'c.id')->leftjoin('branches as b', 'mst_account.branch_id', '=', 'b.id')->leftjoin('account_status as st', 'mst_account.account_status_id', '=', 'st.id')->leftjoin('loan_types as lt', 'mst_account.loan_type_id', '=', 'lt.id')->orderBy('mst_account.id', 'DESC');
        return DataTables::of($accounts)
        ->addColumn('action', function ($accounts){
            return '<a class="btn btn-rounded btn-info btn-xs" href="accounts/'.$accounts->id.'/edit"><i class="fa fa-edit"></i>Edit</a>';
        })
        ->addColumn('fullname', function($accounts){
            $full = $accounts->first_name.' '.$accounts->middle_name. ' '.$accounts->last_name;
            return $full;
        })
        ->make(true);
    }
    private function onProcess($account_id){
        try{
            $checkstatus = AccountLoanProcess::where('account_id', $account_id)->count();
            if($checkstatus == 0){
                $account = Account::find($account_id);
                    if ($account->property_collateral->count() > 0 && $account->account_identification->count() > 0) {
                        $processes = LoanProcess::all();
                        $account->account_status_id = 2;
                        $account->save();
                        $count = 0;
                        foreach ($processes as $process) {
                            $count++;
                            $loan_process = new AccountLoanProcess;
                            $loan_process->account_id = $account_id;
                            $loan_process->loan_process_id = $process->id;
                            if ($count == 1) {
                                $loan_process->status = 1;
                            }else{
                                $loan_process->status = 0;
                            }
                            $loan_process->save();
                        }
                    return 1;
                }
            }else{
                return 1;
            }
            
        }catch(\Exception $e){
            // throw $e;
            abort(404, 'Item not Found!');
        }
    }

    public function storeidentification(Request $request){
        try{
            $added_by = Auth::user()->id;
            $convert = json_decode($request->idsprovided);

            foreach($convert as $con){
                $save = new AccountIdentification();
                $save->account_id = $con->account_id;
                $save->identification_list_id = $con->identification_list_id;
                $save->id_number = $con->id_number;
                $save->added_by = $added_by;
                $save->updated_by = $added_by;
                $save->save();
            }


            return "success";
        }catch(\Exception $e){
            throw $e;
            // return "Unexpected Error Occured!";
        }
        
    }

    private function processdash($id){
        dd($id);
    }

    public function approved_loan(){
        $accounts = Account::select('mst_account.id', 'lt.name as type', 'mst_account.account_number', 'c.first_name', 'c.middle_name', 'c.last_name', 'b.name', 'st.name as status')->leftjoin('clients as c', 'mst_account.client_id', '=', 'c.id')->leftjoin('branches as b', 'mst_account.branch_id', '=', 'b.id')->leftjoin('account_status as st', 'mst_account.account_status_id', '=', 'st.id')->leftjoin('loan_types as lt', 'mst_account.loan_type_id', '=', 'lt.id')->where('mst_account.account_status_id', 3)->orWhere('mst_account.account_status_id', 4)->orderBy('mst_account.id', 'DESC');
        return DataTables::of($accounts)
        ->addColumn('action', function ($accounts){
            return '<a class="btn btn-rounded btn-info btn-xs" href="payment/'.$accounts->id.'/pay-loan"><i class="fa fa-money"></i>Pay</a>';
        })
        ->addColumn('fullname', function($accounts){
            $full = $accounts->first_name.' '.$accounts->middle_name. ' '.$accounts->last_name;
            return $full;
        })
        ->make(true);
    }
}
