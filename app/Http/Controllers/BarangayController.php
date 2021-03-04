<?php

namespace App\Http\Controllers;

use App\Barangay;
use App\City;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\Datatables;

class BarangayController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.barangays.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $city = City::all();
        return view('pages.barangays.create',compact('city'));
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
            'name' => 'required',
            'city_id' => 'required',
        ]);
        $barangay = new Barangay($request->all());
        $barangay->save();
        return redirect('barangays/'.$barangay->id.'/edit')->with('message','New Barangay has been added successfully'); 
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
        $barangay = Barangay::find($id);
        $city = City::all();
        return view('pages.barangays.edit',compact('barangay','city'));
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
        $validateData = $request->validate([
            'name' => 'required',
            'city_id' => 'required',
        ]);
        $barangay = Barangay::find($id);
        $barangay->name = $request->name;
        $barangay->city_id = $request->city_id;
        $barangay->save();
        return redirect('barangays/'.$barangay->id.'/edit')->with('message','New Barangay has been updated successfully'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $barangay = Barangay::find($id);
        $barangay->delete();
    }
    public function getBarangay(){
        $barangays = Barangay::with('City');
        return Datatables::of($barangays)
            ->addColumn('action',function($barangays){
                 return '<a class="btn btn-rounded btn-success btn-xs" href="barangays/'.$barangays->id.'"><i class="fa fa-eye"></i>View</a><a class="btn btn-rounded btn-info btn-xs" href="barangays/'.$barangays->id.'/edit"><i class="fa fa-edit"></i>Edit</a><a class="btn btn-rounded btn-danger btn-xs" href="#" id="delete" data-id="'.$barangays->id.'" data-name="'.$barangays->name.'"><i class="fa fa-trash"></i>Delete</a>';
            })
            ->make(true);
        
    }
}
