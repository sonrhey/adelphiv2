<?php

namespace App\Http\Controllers;

use App\Industry;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class IndustryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.industry.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.industry.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $industry = new Industry($request->all());
        $industry->save();

        return back()->with('message', 'Record Successfully Created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $industry = Industry::find($id);
        return view('pages.industry.view', compact('industry'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $industry = Industry::find($id);
        return view('pages.industry.edit', compact('industry', 'id'));
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
        $industry = Industry::find($id);
        $industry_input = $request->all();
        $industry->fill($industry_input)->save();

        return back()->with('message', 'Record Successfully Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       Industry::find($id)->delete();
       return back()->with('message', 'Record Successfully Deleted!');
    }

    public function get_all() {
        $industry = Industry::all();
        return DataTables::of($industry)
        ->addColumn('action', function ($industry){
            return '
            <div class="btn-group" role="group" aria-label="Basic example">
            <a class="btn btn-rounded btn-success btn-xs" href="industry/'.$industry->id.'"><i class="fa fa-eye"></i> View</a>
                <a class="btn btn-rounded btn-info btn-xs" href="industry/'.$industry->id.'/edit"><i class="fa fa-edit"></i> Edit</a>
                <a class="btn btn-rounded btn-danger btn-xs" href="industry/'.$industry->id.'/delete_industry"><i class="fa fa-trash"></i> Delete</a>
            </div>';
        })
        ->make(true);
    }
}
