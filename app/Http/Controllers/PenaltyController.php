<?php

namespace App\Http\Controllers;

use App\Penalties;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\Datatables;


class PenaltyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('pages.penalties.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view ('pages.penalties.create');

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
            'name' => 'required|unique:penalties',
            'percentage' => 'required',
        ]);
        $equivalent = number_format($request->percentage / 100, 2);
        $penalty = new Penalties;
        $penalty->name = $request->name;
        $penalty->percentage = $request->percentage;
        $penalty->equivalent = $equivalent;
        $penalty->save();

        return redirect('penalties/'.$penalty->id.'/edit')->with('message', 'New Penalty has been successfully added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $penalty = Penalties::find($id);

        return view('pages.penalties.view',compact('penalty'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $penalty = Penalties::find($id);
        
        return view('pages.penalties.edit',compact('penalty'));

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
            'percentage' => 'required',
        ]);
        $equivalent = number_format($request->percentage / 100, 2);
        $penalty = Penalties::find($id);
        $penalty->name = $request->name;
        $penalty->percentage = $request->percentage;
        $penalty->equivalent = $equivalent;
        $penalty->save();

        return redirect('penalties/'.$penalty->id.'/edit')->with('message', 'New Penalty has been successfully updated');
    }
    public function getPenalties(){
        $penalty = Penalties::all();
        return Datatables::of($penalty)

            ->addColumn('action', function($penalty){
                return '<a class="btn btn-rounded btn-success btn-xs" href="penalties/'.$penalty->id.'"><i class="fa fa-eye"></i>View</a><a class="btn btn-rounded btn-info btn-xs" href="penalties/'.$penalty->id.'/edit"><i class="fa fa-edit"></i>Edit</a> <a class="btn btn-rounded btn-danger btn-xs" href="#" id="delete" data-id="'.$penalty->id.'" data-name="'.$penalty->name.'"><i class="fa fa-trash"></i>Delete</a>';
                
            })
            ->editColumn('percentage',function($penalty){
                return number_format($penalty->percentage, 1)."%";
            })
            ->make(true);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        
        $penalty = Penalties::find($id);
        $penalty->delete();

    }
}
