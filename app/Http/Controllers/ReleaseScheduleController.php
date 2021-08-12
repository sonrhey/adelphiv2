<?php

namespace App\Http\Controllers;

use App\ReleaseSchedule;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\Datatables;

class ReleaseScheduleController extends Controller
{
    public function PaymentSchedule($id){
        $releaseSchedule = ReleaseSchedule::where('account_id', $id)->get();
        return Datatables::of($releaseSchedule)->make(true);
    }
    //
}
