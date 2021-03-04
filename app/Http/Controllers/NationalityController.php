<?php

namespace App\Http\Controllers;

use App\Bank;
use App\Nationality;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\Datatables;
class NationalityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.nationalities.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.nationalities.create');
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
            'name' => 'required|unique:nationalities',
        ]);

        $addNationality = new Nationality;
        $addNationality->name = $request->name;
        $addNationality->save();
        return redirect ('/nationality/'.$addNationality->id.'/edit')->with('message', 'New Nationality has been successfully added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $nationality = Nationality::find($id);
        return view('pages.nationalities.view',compact('nationality','id'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($nationalityId)
    {
        $nationality = Nationality::find($nationalityId);
        return view('pages.nationalities.edit',compact('nationalityId','nationality'));
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
        $nationality = Nationality::find($id);
        $nationality->name = $request->name;
        $nationality->save();
        return redirect ('/nationality/'.$nationality->id.'/edit')->with('message','Nationality has been successfully updated');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = Nationality::find($id);
        $delete->delete();
        // return back();
    }
    public function getNationality(){
        csrf_token();
        $nationality = Nationality::all();

        return Datatables::of($nationality)
            ->addColumn('action', function($nationality){
                return '<a class="btn btn-rounded btn-success btn-xs" href="nationality/'.$nationality->id.'"><i class="fa fa-eye"></i>View</a><a class="btn btn-rounded btn-info btn-xs" href="nationality/'.$nationality->id.'/edit"><i class="fa fa-edit"></i>Edit</a> <a class="btn btn-rounded btn-danger btn-xs" href="#" id="delete" data-id="'.$nationality->id.'" data-name="'.$nationality->name.'"><i class="fa fa-trash"></i>Delete</a>';
                // 
            })->make(true);
    }
}
