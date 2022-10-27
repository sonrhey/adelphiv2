<?php

namespace App\Http\Controllers;

use App\Barangay;
use App\City;
use App\CivilStatus;
use App\Client;
use App\ClientFamily;
use App\ClientRelation;
use App\Nationality;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Yajra\DataTables\Facades\Datatables;
class ClientFamilyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($client)
    {
         $family = ClientFamily::leftjoin('client_relations as cr', 'client_family.client_relation_id', '=', 'cr.id')->select('client_family.id', 'client_family.first_name', 'client_family.middle_name', 'client_family.last_name', 'cr.name as relation')->where('client_id', $client);
        return DataTables::of($family)
        ->addColumn('action', function ($family)use ($client){
            return '<a class="btn btn-rounded btn-info btn-xs" href="family/'.$family->id.'/edit"><i class="fa fa-edit"></i>Edit</a>
            <form id="df" action="family/'.$family->id.'" method="POST">
            <a class="btn btn-rounded btn-danger btn-xs" href="javascript:$(df).submit();" id="delete" data-id="'.$family->id.'"><i class="fa fa-delete"></i>Delete</a>

            <input type="hidden" name="_method" value="DELETE">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            </form>';
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
        $this->clientExist($client);
        $relations = ClientRelation::all();
        $nationality = Nationality::all();
        $civil_status = CivilStatus::all();
        $city = City::all();
        $barangay = Barangay::all();
        return view('pages.clients.family.create', compact('client', 'relations','city','nationality','civil_status','barangay'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $client)
    {
        $family = new ClientFamily($request->all());
        $family->client_id = $client;
        $family->status = 1;
        $family->added_by = Auth::user()->id;

        $family->save();
        return redirect('clients/'.$client.'/edit')->with('message', 'New family member successfully added.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id,$famid)
    {

        $family = ClientFamily::find($famid);

        return view('pages.clients.family.view',compact('family','id','famid'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id,$famid)
    {
        $family = ClientFamily::find($famid);
        $civil_status = CivilStatus::all();
        $relation = ClientRelation::all();
        $nationality = Nationality::all();
        $city = City::all();
        $barangay = Barangay::all();
        return view('pages.clients.family.edit',compact('id','famid','family','civil_status','relation','nationality','city','barangay'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id,$famid)
    {

        $family = ClientFamily::findorFail($famid);
        $family->fill($request->all());
        $family->client_id = $id;
        $family->updated_by = Auth::user()->id;
        $family->save();
        return redirect('/clients/'.$id.'/family/'.$family->id.'/edit')->with('message', 'New client has been successfully Updated.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $client_fam = ClientFamily::find($id)->delete();
        return Redirect::back()->with('message', 'Client Family was deleted successfuly!');
    }
    private function clientExist($client)
    {
        $client = Client::find($client);
        if (is_null($client)) {
            abort(401, 'Access denied');
        }
    }
    public function viewFamily($id){
         $family = ClientFamily::leftjoin('client_relations as cr', 'client_family.client_relation_id', '=', 'cr.id')->select('client_family.id', 'client_family.first_name', 'client_family.middle_name', 'client_family.last_name', 'cr.name as relation')->where('client_id', $id);
        return DataTables::of($family)
        ->addColumn('action', function ($family)use ($id){
            return '<a class="btn btn-rounded btn-success btn-xs" href="family/'.$family->id.'"><i class="fa fa-view"></i>View';
        })

        ->make(true);
    }

}
