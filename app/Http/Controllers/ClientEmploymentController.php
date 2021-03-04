<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Client;
use App\ClientEmployment;
use Auth;
use Yajra\DataTables\Facades\Datatables;
class ClientEmploymentController extends Controller
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
    public function show($id,$employmentid)
    {

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
        //
    }
    public function viewEmployment($id){
        $employment = ClientEmployment::leftjoin('employment_status as es', 'client_employment.employment_status_id', '=', 'es.id')
        ->leftjoin('clients as c','client_employment.client_id','=','c.id')
         ->select('client_employment.id','company_name','position','length_stay','monthly_income','es.name as status')
         ->where('client_id', $id);
        return DataTables::of($employment)
        ->addColumn('action', function ($employment)use ($id){
            return '<a class="btn btn-rounded btn-success btn-xs" href="employments/'.$employment->id.'"><i class="fa fa-edit"></i>View</a>';
        })->make(true);
       
    }
}
