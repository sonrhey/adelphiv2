<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Account;
use App\ChequeManagement;
use DB;
use Yajra\DataTables\Facades\Datatables;

class ChequeManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.cheque_management.index');
        //
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
        DB::beginTransaction();
        try{
            $cheque_management = new ChequeManagement($request->all());
            $cheque_management->save();
            DB::commit();
            return redirect()->back();
        }catch(\Exception $ex){
            DB::rollback();
            dd($ex);
        }
    }

    public function get(){
        $cheques = ChequeManagement::where('cheque_value', '>', 0)->get();
        return Datatables::of($cheques)

            ->editColumn('client_name', function($cheques){
                $client_name = [$cheques->client_name->first_name, $cheques->client_name->middle_name, $cheques->client_name->last_name];
                $client_name = join(" ", $client_name);
                return $client_name;
            })
            ->editColumn('cheque_value', function($cheques){
                return number_format($cheques->cheque_value, 2, '.', ',');
            })
            ->editColumn('bank_name', function($cheques){
                return $cheques->bank_name->name;
            })
            ->addColumn('action', function($cheques){
                return '<a class="btn btn-rounded btn-info btn-xs btn-edit" href="#" data-cheque-id="'.$cheques->id.'"><i class="fa fa-edit"></i>Edit</a>';
                // 
            })->make(true);
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
            DB::beginTransaction();
        try{
            $cheque = ChequeManagement::find($request->cheque_id);
            $cheque->client_id = $request->selected_client_id;
            $cheque->bank_id = $request->selected_bank_id;
            $cheque->cheque_name = $request->selected_cheque_name;
            $cheque->cheque_value = $request->selected_cheque_value;
            $cheque->save();
            DB::commit();
            return redirect()->back();
        }catch(Exception $ex){
            DB::rollback();
            return redirect()->back();
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

    public function account_numbers(){
        $get_account = Account::all();
        return response()->json($get_account);
    }
}
