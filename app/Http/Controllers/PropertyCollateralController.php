<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PropertyCollateral;
use Yajra\DataTables\Facades\Datatables;
use Auth;
use App\PropertyType;
use App\UnitOfMeasure;
use App\Barangay;
use App\City;
class PropertyCollateralController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($accounts)
    {
        // $proprties = PropertyCollateral::leftjoin('cities as c', 'property_collaterals.city_id', '=', 'c.id')->leftjoin('barangays as b', 'property_collaterals.barangay_id', '=', 'b.id');
         $properties = PropertyCollateral::where('account_id', $accounts);
        return DataTables::of($properties)
        ->addColumn('action', function ($properties)use ($accounts){
            return '<a class="btn btn-rounded btn-info btn-xs" href="property_collaterals/'.$properties->id.'/edit"><i class="fa fa-edit"></i>Edit</a>';
        })

        ->make(true);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response`
     */
    public function create($accounts)
    {
        $property_types = PropertyType::all();
        $unit_measures = UnitOfMeasure::all();
        $barangays = Barangay::all();
        $cities = City::all();
        return view('pages.property_collaterals.create', compact('accounts', 'property_types', 'unit_measures', 'barangays', 'cities'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $accounts)
    {
        try{
            $property_collateral = new PropertyCollateral($request->all());
            $property_collateral->account_id = $accounts;
            $property_collateral->added_by = Auth::user()->id;
            $property_collateral->save();
            return redirect('accounts/'.$accounts.'/edit');
        }catch(\Exception $ex){
            throw $ex;
        }
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
    public function edit($accounts, $id)
    {
        $property = PropertyCollateral::find($id);
        $property_types = PropertyType::all();
        $unit_measures = UnitOfMeasure::all();
        $barangays = Barangay::all();
        $cities = City::all();
        return view('pages.property_collaterals.edit', compact('property', 'accounts', 'id', 'property_types', 'unit_measures', 'barangays', 'cities'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, $collateral_id)
    {
        $property_collateral = PropertyCollateral::find($collateral_id);
        $property_collateral_input = $request->all();
        $property_collateral->fill($property_collateral_input)->save();

        return back()->with('message', 'Record Successfully Updated!');
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
}
