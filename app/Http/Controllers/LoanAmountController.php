<?php

namespace App\Http\Controllers;

use App\LoanAmount;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class LoanAmountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // dd($loanamount);
        return view('pages.loanamount.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.loanamount.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            $loanamount = new LoanAmount($request->all());
            $loanamount->save();
            return redirect('loan_amount/'.$loanamount->id.'/deductions/create');
        }catch(\Exception $e){
            return redirect()->back()->with('error_message', 'Amount already exist!');
        }
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
        LoanAmount::find($id)->delete();
        return back()->with('message', 'Record Successfully Deleted!');
    }

    public function getloanamount(){
        $loanamount = LoanAmount::select(['loan_amounts.id', 'loan_amounts.amount as amount', 'cd.id as cdid', 'cd.total_handling_fee as total_handling_fee','cd.total_notarial as total_notarial','cd.total_annotation as total_annotation','cd.total_deductions as total_deductions','cd.net_proceeds as net_proceeds', 'dl.location_name'])->leftJoin('charges_details as cd', 'loan_amounts.id', '=', 'cd.loan_amount_id')->leftJoin('deduction_locations as dl', 'cd.location_deduction_id', '=', 'dl.id');
        return DataTables::of($loanamount)
        ->addColumn('action', function ($loanamount){
            $url = '';
            $view_url = '';
            if ($loanamount->cdid === null) {
                $url = 'loan_amount/'.$loanamount->id.'/deductions/create';
            } else {
                $url = '/loan_amount/'.$loanamount->id.'/deductions/'.$loanamount->cdid.'/edit';
                $view_url = '<a class="btn btn-rounded btn-success btn-xs" href="/loan_amount/'.$loanamount->id.'/deductions/'.$loanamount->cdid.'/view"><i class="fa fa-eye"></i>View</a>  ';
            }
            return '
            <div class="btn-group" role="group" aria-label="Basic example">
                '.$view_url.'
                <a class="btn btn-rounded btn-info btn-xs" href="'.$url.'"><i class="fa fa-edit"></i>Edit</a>
                <a class="btn btn-rounded btn-danger btn-xs" href="loan_amount/'.$loanamount->id.'/deleteloanamount" id="delete" data-id=""><i class="fa fa-trash"></i>Delete</a>
            </div>';
        })
        ->make(true);
    }
}
