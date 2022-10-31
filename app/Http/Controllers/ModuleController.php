<?php

namespace App\Http\Controllers;

use App\Module;
use App\User;
use App\UserType;
use App\UserAccess;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\Datatables;

class ModuleController extends Controller
{
   public function index(){
   	$user = Auth::id();
   	$submodule = Module::where('routes','!=','modules')
         ->where('routes','!=','addmodules')
         ->get();
   	return view ('Modules.module', compact('submodule','usertype'));

   }
   public function addmodules(){
      $id = Auth::user()->id;
      if ($id != 1) {
         abort(401, 'Access denied');
      }

      return view ('pages.modules.index');
   }
   public function storemodules (Request $request){
      $name = $request->name;
      $type = $request->_type;
      $parentid = $request->parent;
      $toLower = strtolower($name);
      $route = str_replace(" ","", $toLower);

      $usertype = UserType::all();
      if ($type == 1) {
         $add = new Module;
         $add->name = $name;
         $add->has_sub = 0;
         $add->routes = $route;
         $add->parent = 0;
         $add->visible = 1;
         $add->sequence = 1;
         $add->save();
         foreach ($usertype as $ut) {
            if ($ut->id == 1) {
               $sadmin = new UserAccess;
               $sadmin->module_id = $add->id;
               $sadmin->user_type_id = $ut->id;
               $sadmin->grant = 1;
               $sadmin->save();
            }else{
               $sadmin = new UserAccess;
               $sadmin->module_id = $add->id;
               $sadmin->user_type_id = $ut->id;
               $sadmin->grant = 0;
               $sadmin->save();
            }
         }
         return redirect('addmodules')->with('message','New modules has been added successfully');

      }else if($type == 2){
         $find = Module::find($parentid);
         $find->has_sub = 1;
         $find->save();

         $add = new Module;
         $add->name = $name;
         $add->has_sub = 0;
         $add->routes = $route;
         $add->parent = $parentid;
         $add->visible = 1;
         $add->sequence = 1;
         $add->save();

         foreach ($usertype as $ut) {
            if ($ut->id == 1) {
               $sadmin = new UserAccess;
               $sadmin->module_id = $add->id;
               $sadmin->user_type_id = $ut->id;
               $sadmin->grant = 1;
               $sadmin->save();
            }else{
               $sadmin = new UserAccess;
               $sadmin->module_id = $add->id;
               $sadmin->user_type_id = $ut->id;
               $sadmin->grant = 0;
               $sadmin->save();
            }
         }
         return redirect('addmodules')->with('message','New modules has been added successfully');
      }else{
         return redirect('addmodules')->with('error_message','Please Select module type');
      }
   }
   public function getparent($id){
      $getparent = Module::where('parent',0)->get();
      return $getparent;
   }
   public function store(Request $request){
      // $user = Auth::id();
   	$mname = $request->name;
   	$subname = $request->parent;
   	$route = $request->route;
      $type = $request->_type;
      $usertype = UserType::all();

   	if($type == 1){

   		$addmodule = new Module;
   		$addmodule->module_name = $mname;
   		$addmodule->hasSubmodule = $subname;
   		$addmodule->routes = $route;
   		$addmodule->parent = 0;
   		$addmodule->save();
         $id = $addmodule->id;

         foreach ($usertype as $ut) {
            if ($ut->id == 1) {
               $sadmin = new UserAccess;
               $sadmin->module_id = $id;
               $sadmin->user_type_id = $ut->id;
               $sadmin->grant = 0;
               $sadmin->save();
            }else{
               $sadmin = new UserAccess;
               $sadmin->module_id = $id;
               $sadmin->user_type_id = $ut->id;
               $sadmin->grant = 0;
               $sadmin->save();
            }
         }

      }else{

         $up = Module::find($subname);
         $up->hasSubmodule = 1;
         $up->parent = 0;
         $up->save();

	   	$addmodules = new Module;
	   	$addmodules->module_name = $mname;
	   	$addmodules->hasSubmodule = 0;
	   	$addmodules->routes = $route;
	   	$addmodules->parent = $subname;
	   	$addmodules->save();
         $id1 = $addmodules->id;

         foreach ($usertype as $ut1) {
            if ($ut1->id == 1) {
               $sadmin = new UserAccess;
               $sadmin->module_id = $id1;
               $sadmin->user_type_id = $ut1->id;
               $sadmin->grant = 0;
               $sadmin->save();
            }else{
               $sadmin = new UserAccess;
               $sadmin->module_id = $id1;
               $sadmin->user_type_id = $ut1->id;
               $sadmin->grant = 0;
               $sadmin->save();
            }

   	   }
      }
   	return redirect('home');
   }

   public function usermaintenance (){
      return view('pages.user_maintenance.index');
   }
   public function editUser($id){
      $usertypeid = Auth::user()->user_type_id;
      $usertype = UserType::all();
      $modules = Module::all();
      $useraccess = UserAccess::where('user_type_id',$usertypeid)->get();
      $user = User::find($id);

      return view('pages.user_maintenance.edit',compact('user','usertype','modules','useraccess'));
   }
   public function storeUser(Request $request,$id){
      $user = User::find($id);
      $user->first_name = $request->first_name;
      $user->last_name = $request->last_name;
      $user->username = $request->username;
      $user->user_type_id = $request->usertypeid;
      $user->save();

   }
    public function storeAccessUser(Request $request,$id){
      $user = User::find($id);

      $useracc = UserAccess::where('user_type_id',$user->user_type_id)
         ->where('module_id',$request->id)->first();
      if ($request->check == 0) {
         if (!is_null($useracc)) {
            $useracc->grant = 0;
            $useracc->save();
         }else{
            $addnew = new UserAccess;
            $addnew->module_id = $request->id;
            $addnew->user_type_id = $user->user_type_id;
            $addnew->grant = 0;
            $addnew->save();
         }
      }else{
         if (!is_null($useracc)) {
            $useracc->grant = 1;
            $useracc->save();
         }else{
            $addnew = new UserAccess;
            $addnew->module_id = $request->id;
            $addnew->user_type_id = $user->user_type_id;
            $addnew->grant = 1;
            $addnew->save();
         }
      }



   }

   public function getUsers(){
      $get = User::with('user_type')->get();
      return Datatables::of($get)
         ->addColumn('action', function($users){
            return '
            <div class="d-flex">
                <a class="btn btn-rounded btn-info btn-xs" href="usermaintenance/'.$users->id.'/edit"><i class="fa fa-edit"></i>Edit</a>
                <form id="df" action="usermaintenance/'.$users->id.'/delete_user" method="POST">
                <a class="btn btn-rounded btn-danger btn-xs" href="javascript:$(df).submit();" id="delete" data-id="'.$users->id.'"><i class="fa fa-delete"></i>Delete</a>

                <input type="hidden" name="_method" value="DELETE">
                <input type="hidden" name="_token" value="'.csrf_token().'">
                </form>
            </div>';

         })->make(true);
   }
   public function company(){
      return view ('Company.company');
   }

   public function test (){
      return view ('test');
   }

   public function create_new_user() {
    $usertype = UserType::all();
    return view('pages.user_maintenance.create', compact('usertype'));
   }

   public function store_user(Request $request) {
    $user = new User($request->all());
    $user->password = bcrypt($request->password);
    $user->save();

    return back()->with('message', 'User Successfully Created!');
   }

   public function delete_user($id) {
    User::find($id)->delete();

    return back()->with('message', 'User Successfully Deleted!');
   }
}
