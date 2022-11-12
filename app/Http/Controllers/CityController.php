<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\Facades\Datatables;
use Carbon\Carbon;
use App\City;
use App\DeductionLocation;
use Auth;
class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.cities.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.cities.create');
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
            'name' => 'required|unique:cities',
        ]);
        $city = new City;
        $city->name = $request->name;
        $city->save();

        $deduction_location = new DeductionLocation();
        $deduction_location->location_name = $request->name;
        $deduction_location->save();

        return redirect('/cities/'.$city->id.'/edit')->with('message','New City has been successfully added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $city = City::find($id);
        return view('pages.cities.view',compact('city','id'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $city = City::find($id);
        return  view('pages.cities.edit',compact('city','id'));
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
        $city = City::find($id);
        $city->name = $request->name;
        $city->save();

        return redirect('/cities/'.$id.'/edit')->with('message','City has been successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $city = City::find($id);
       $city->delete();

       // return back();
    }
    public function getCity(){
        $city = City::all();
        return Datatables::of($city)
            ->addColumn('action',function($city){
                return '<a class="btn btn-rounded btn-success btn-xs" href="cities/'.$city->id.'"><i class="fa fa-eye"></i>View</a><a class="btn btn-rounded btn-info btn-xs" href="cities/'.$city->id.'/edit"><i class="fa fa-edit"></i>Edit</a> <a class="btn btn-rounded btn-danger btn-xs" href="#" id="delete" data-id="'.$city->id.'" data-name="'.$city->name.'"><i class="fa fa-trash"></i>Delete</a>';
                //
            })->make(true);
    }
}
