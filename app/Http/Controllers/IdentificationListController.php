<?php

namespace App\Http\Controllers;

use App\IdentificationList;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class IdentificationListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.identification_list.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.identification_list.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $identification = new IdentificationList($request->all());
        $identification->save();

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
        $identification = IdentificationList::find($id);
        return view('pages.identification_list.view', compact('identification'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $identification = IdentificationList::find($id);
        return view('pages.identification_list.edit', compact('identification', 'id'));
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
        $identification = IdentificationList::find($id);
        $identification_input = $request->all();
        $identification->fill($identification_input)->save();

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
        IdentificationList::find($id)->delete();

        return back()->with('message', 'Record Successfully Deleted!');
    }

    public function get_all() {
        $identification = IdentificationList::all();
        return DataTables::of($identification)
        ->addColumn('action', function ($identification){
            return '
            <div class="d-flex" role="group" aria-label="Basic example">
                <a class="btn btn-rounded btn-success btn-xs" href="identification_list/'.$identification->id.'"><i class="fa fa-eye"></i> View</a>
                <a class="btn btn-rounded btn-info btn-xs" href="identification_list/'.$identification->id.'/edit"><i class="fa fa-edit"></i> Edit</a>
                <form id="df" action="identification_list/'.$identification->id.'" method="POST">
                <a class="btn btn-rounded btn-danger btn-xs" href="javascript:$(df).submit();" id="delete" data-id="'.$identification->id.'"><i class="fa fa-trash"></i> Delete</a>
                <input type="hidden" name="_method" value="DELETE">
                <input type="hidden" name="_token" value="'.csrf_token().'">
                </form>
            </div>';
        })
        ->make(true);
    }
}
