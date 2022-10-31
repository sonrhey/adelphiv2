<?php

namespace App\Http\Controllers;

use App\AccountIdentification;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class AccountIdentificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $accountid = AccountIdentification::select(['account_identifications.id','account_identifications.id_number','il.name'])->leftJoin('identification_list as il','account_identifications.identification_list_id', '=', 'il.id')->where('account_id', $id);
        return DataTables::of($accountid)
        ->addColumn('action', function ($accountid){
            return '<a class="btn btn-rounded btn-danger btn-xs" href="identification/'.$accountid->id.'/destroy"><i class="fa fa-trash"></i> Remove</a>';
        })

        ->make(true);
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
    public function destroy($account_id, $identification_id)
    {
       AccountIdentification::find($identification_id)->delete();
       return back()->with('message', 'Record Successfully Deleted!');
    }
}
