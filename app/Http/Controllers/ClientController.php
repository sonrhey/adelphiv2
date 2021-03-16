<?php

namespace App\Http\Controllers;

use App\Barangay;
use App\City;
use App\CivilStatus;
use App\Client;
use App\Nationality;
use Auth;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\Datatables;
class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        return view('pages.clients.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $civil_status = CivilStatus::all();
        $nationality = Nationality::all();   
        $civil_status = CivilStatus::all();
        $city = City::all();
        $barangay = Barangay::all();
        return view('pages.clients.create', compact('civil_status','nationality','civil_status','city','barangay'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->civil_status_id);
        $client = new Client($request->all());
        $client->status = 'PENDING';
        $client->added_by = Auth::user()->id; 
        $client->save();
        return redirect('/clients/'.$client->id.'/edit')->with('message', 'New client has been successfully added.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $client = Client::find($id);
        return view('pages.clients.view',compact('client','id'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $client = Client::find($id);   
        $nationality = Nationality::all();   
        $civil_status = CivilStatus::all();
        $city = City::all();
        $barangay = Barangay::all();

        return view('pages.clients.edit', compact('client','nationality','city','barangay','civil_status','id'));
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
        $client = Client::findorFail($id);
        $client->fill($request->all());
        $client->status = 'PENDING';
        $client->added_by = Auth::user()->id; 
        $client->updated_by = Auth::user()->id;
        $client->save();
        return redirect('/clients/'.$client->id.'/edit')->with('message', 'New client has been successfully Updated.');
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
    public function getClients()
    {
        $clients = Client::all();
        return DataTables::of($clients)
        ->addColumn('action', function ($clients){
            return '<a class="btn btn-rounded btn-success btn-xs" href="clients/'.$clients->id.'/view"><i class="fa fa-view"></i>View</a><a class="btn btn-rounded btn-info btn-xs" href="clients/'.$clients->id.'/edit"><i class="fa fa-edit"></i>Edit</a><a class="btn btn-rounded btn-danger btn-xs" href="#" id="delete" data-id="'.$clients->id.'"><i class="fa fa-delete"></i>Delete</a>';
        })
        ->make(true);
    }

    public function client_list(){
        $get_client = Client::all();
        return response()->json($get_client);
    }

}
