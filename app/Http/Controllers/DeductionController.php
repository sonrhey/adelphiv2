<?php

namespace App\Http\Controllers;

use App\ChargesDetails;
use App\LoanAmount;
use App\DeductionLocation;
use Illuminate\Http\Request;

class DeductionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        try{
            $loanamount = LoanAmount::find($id);
            $dlocation = DeductionLocation::all();
            return view('pages.deductions.create', compact('loanamount', 'id', 'dlocation'));
        }catch(\Exception $e){
            // abort(404, 'Item not Found!');
            throw $e;
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        try{
            $store = new ChargesDetails($request->all());
            $store->loan_amount_id = $id;
            $store->save();
            return redirect('loan_amount');
        }catch(\Exception $e){
            // abort(404, 'Item not Found!');
            throw $e;
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
        dd($id);
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, $deduction_id)
    {
        try{
            $loanamount = LoanAmount::find($id)->deductions()->where('id', $deduction_id)->first();
            $amount = ChargesDetails::where('loan_amount_id', $id)->where('id', $deduction_id)->first();
            $dlocation = DeductionLocation::all();
            return view('pages.deductions.edit', compact('loanamount', 'id', 'amount', 'dlocation'));
        }catch(\Exception $e){
            // abort(404, 'Item not Found!');
            throw $e;
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $loan_amount_id, $deductionsid)
    {
        try{
            $flight = ChargesDetails::updateOrCreate(
                ['id' => $deductionsid, 'location_deduction_id' => $request->location_deduction_id],
                $request->all()
            );

            // $chargesdetails = ChargesDetails::find($deductionsid);
            // $chargesdetails->update($request->all());

            return redirect()->back()->with('message', 'Deductions Updated!');
        }catch(\Exception $e){
            // return redirect()->back()->with('error_message', 'Please check your inputs!');
            throw $e;
        }        
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

    public function viewdeductions($id, $deduction_id){
        try{
            $dlocation = DeductionLocation::all();
            $loanamount = LoanAmount::find($id)->deductions()->where('id', $deduction_id)->first();
            $amount = ChargesDetails::where('loan_amount_id', $id)->where('id', $deduction_id)->first();
            return view('pages.deductions.show', compact('loanamount', 'id', 'amount', 'dlocation'));
        }catch(\Exception $e){
            throw $e;
        }
    }
}
