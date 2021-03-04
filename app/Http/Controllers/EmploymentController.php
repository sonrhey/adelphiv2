<?php

namespace App\Http\Controllers;

use App\Barangay;
use App\City;
use App\ClientEmployment;
use App\EmploymentStatus;
use App\Industry;
use Auth;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\Datatables;
class EmploymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($client)
    {
        $employment = ClientEmployment::leftjoin('employment_status as es', 'client_employment.employment_status_id', '=', 'es.id')
         ->select('client_employment.id','company_name','position','length_stay','monthly_income','es.name as status')
         ->where('client_id', $client);
        return DataTables::of($employment)
        ->addColumn('action', function ($employment)use ($client){
            return '<a class="btn btn-rounded btn-info btn-xs" href="employments/'.$employment->id.'/edit"><i class="fa fa-edit"></i>Edit</a><a class="btn btn-rounded btn-danger btn-xs" href="#" id="delete" data-id="'.$employment->id.'"><i class="fa fa-delete"></i>Delete</a>';
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
        $statuses = EmploymentStatus::all();
        $industries = Industry::all();
        $city = City::all();
        $barangay = Barangay::all();
        return view('pages.employments.create', compact('client', 'statuses', 'industries','city','barangay'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $client)
    {
        $employment = new ClientEmployment($request->all());
        $employment->added_by = Auth::user()->id;
        $employment->client_id = $client;
        $employment->save();
        return redirect('/clients/'.$client.'/edit')->with('message', 'New client has been successfully added.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id,$employmentid)
    {
        $employment = ClientEmployment::find($employmentid);
        return view('pages.employments.view',compact('employment','id','employment_id'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id,$employment_id)
    {
        $employment = ClientEmployment::find($employment_id);
        $barangay = Barangay::all();
        $industries = Industry::all();
        $statuses = EmploymentStatus::all();
        $city = City::all();
        return view('pages.employments.edit',compact('employment','id','employment_id','industries','statuses','city','barangay'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $client,$employment_id)
    {

        $employment = ClientEmployment::findorFail($employment_id);
        $employment->fill($request->all());
        $employment->updated_by = Auth::user()->id;
        $employment->client_id = $client;
        $employment->save();
        return redirect('/clients/'.$client.'/employments/'.$employment->id.'/edit')->with('message', 'New client has been successfully added.');


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
}
