<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bank;
use App\Client;
use App\ClientBank;
use Auth;
use Yajra\DataTables\Facades\Datatables;
class BankAccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($client)
    {
        $bank = ClientBank::leftjoin('banks as b', 'client_bank.bank_id', '=', 'b.id')->where('client_id', $client);
        return DataTables::of($bank)
        ->addColumn('action', function ($bank)use ($client){
            return '<a class="btn btn-rounded btn-info btn-xs" href="bank_accounts/'.$bank->id.'/edit"><i class="fa fa-edit"></i>Edit</a><a class="btn btn-rounded btn-danger btn-xs" href="#" id="delete" data-id="'.$bank->id.'"><i class="fa fa-delete"></i>Delete</a>';
        })
       
        ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($client)
    {
        $banks = Bank::all();
        return view('pages.bank_accounts.create', compact('banks', 'client'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $client)
    {
        $bank = new ClientBank($request->all());
        $bank->client_id = $client;
        $bank->added_by = Auth::user()->id;
        $bank->save();
        return redirect('clients/'.$client.'/edit')->with('message', 'New bank account successfully added.');
     }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id,$bankid)
    {
        $bank = ClientBank::find($bankid);
        return view('pages.bank_accounts.view',compact('bank','id','bankid'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id,$bankid)
    {
        $bankaccount = ClientBank::find($bankid);
        $banks = Bank::all();
        return view('pages.bank_accounts.edit',compact('id','bankid','bankaccount','banks'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id,$bankid)
    {
        $bank = ClientBank::findorFail($bankid);
        $bank->fill($request->all());
        $bank->client_id = $id;
        $bank->updated_by = Auth::user()->id;
        $bank->save();
        return redirect('/clients/'.$id.'/bank_accounts/'.$bank->id.'/edit')->with('message', 'New client has been successfully Updated.');
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
    public function viewBank($id){
        $bank = Client::leftjoin('client_bank as cb', 'clients.id', '=', 'cb.client_id')
            ->select('cb.account_name','cb.id','cb.account_number', 'cb.branch_location', 'cb.year_opened')
            ->where('cb.client_id', $id);
        return DataTables::of($bank)
        ->addColumn('action', function ($bank)use ($id){
            return '<a class="btn btn-rounded btn-success btn-xs" href="bank_accounts/'.$bank->id.'"><i class="fa fa-view"></i>View</a>';
        })->make(true);
    }
}
