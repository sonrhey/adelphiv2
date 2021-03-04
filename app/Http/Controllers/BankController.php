<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\Facades\Datatables;
use Carbon\Carbon;
use App\Bank;
use Auth;

class BankController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.banks.index');
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.banks.create');
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'code' => 'required|unique:banks',
            'name' => 'required|unique:banks',
        ]);

        $bank = new Bank($request->all());
        $bank->created_at = Carbon::now();
        $bank->save();
        return redirect ('/banks/'.$bank->id.'/edit')->with('message','New Bank has been successfully added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $banks = Bank::find($id);
        return view('pages.banks.view',compact('id','banks'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($banks)
    {
        $bank = Bank::find($banks);   
        return view('pages.banks.edit', compact('bank','banks'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $banks)
    {
        

        $bank = Bank::find($banks);
        $bank->code = $request->code;
        $bank->name = $request->name;
        $bank->save();
        return redirect ('/banks/'.$bank->id.'/edit')->with('message','Bank has been successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $bank = Bank::find($id);
        $bank->delete();
        // return back();
    }
    public function getBanks(){
        $banks = Bank::all();
        return Datatables::of($banks)
            ->addColumn('action', function($banks){
                return '<a class="btn btn-rounded btn-success btn-xs" href="banks/'.$banks->id.'"><i class="fa fa-eye"></i>View</a><a class="btn btn-rounded btn-info btn-xs" href="banks/'.$banks->id.'/edit"><i class="fa fa-edit"></i>Edit</a> <a class="btn btn-rounded btn-danger btn-xs" href="#" id="delete" data-id="'.$banks->id.'" data-name="'.$banks->name.'"><i class="fa fa-trash"></i>Delete</a>';
                // 
            })->make(true);

    }
   
}
