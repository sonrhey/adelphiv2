<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Exception;
use App\User;
use App\useraccess;
use App\usertype;
use App\module;

class UsertypeController extends Controller
{
    public function index(){
        $access = useraccess::all();

        $user = Auth::id();
        $getName = User::find($user);
        $usertypeid = $getName->user_type_id;
        $type = usertype::where('id',$getName->usertypeid)->first();
        $modules = module::all();
    	return view('Usertype.addusertype', compact('access','user','getName','usertypeid','type','modules'));
    }
    public function view (){

        $userty = usertype::where('id',1)->first();

    }
    public function store(Request $request){

            $usertypename = $request->typename;

            $addusertype = new usertype;
            $addusertype->name = $usertypename;
            $addusertype->save();
            $usertypeid = $addusertype->id;

            $modules = modules::all();
            foreach ($modules as $m) {

                $newua = new useraccess;
                $newua->module_id = $m->id;
                $newua->user_type_id = $usertypeid;
                $newua->grant = 0;
                $newua->save();

            }

    }

    public function getAccess($id){

        $modules = modules::all();
        $typeAccess = DB::table('user_access as u')
            ->select([
                'm.id',
                'm.module_name',
                'm.hasSubmodule',
                'm.parent',
                'm.routes',
                'u.user_type_id',
                'u.module_id',
                'u.user_type_id',
                'u.grant'
                ])
            ->leftJoin('modules as m', 'u.module_id', '=', 'm.id')
            ->where('user_type_id', $id)
            ->where('routes', '!=','modules')
            ->where('routes', '!=','addmodules')
            ->get();
        // dd($typeAccess);

        $result = '';
        $optionalItem = '';
        $checked = '';
        $mchecked = '';

        foreach ($typeAccess as $taccess) {

            if ($taccess->parent == 0 && $taccess->hasSubmodule == 0) {
                if ($taccess->grant == 1) {
                    $checked = "checked";
                }else{
                    $checked = "";
                }
               $optionalItem .= '
               <div class="container"
                    <label>
                        <input type="checkbox" '.$checked.' name="parentmodule" value='.$taccess->id.' id='.$id.' class="parentm">'.$taccess->module_name.'
                    </label>

                </div>';

           }else if($taccess->parent == 0 && $taccess->hasSubmodule == 1){
                if ($taccess->grant == 1) {
                    $checked = "checked";
                }else{
                    $checked = "";
                }
                $optionalItem .='<div class="container">
                                    <label data-toggle="collapse" data-target="#'.$taccess->routes.'" >
                                        <input type="checkbox" '.$checked.' value='.$taccess->id.' name="parentsub" class="parentsub" id='.$id.' aria-expanded="false">'.$taccess->module_name.'
                                    </label>
                                </div>';

                $optionalItem .='<div id='.$taccess->routes.' aria-expanded="false" class="collapse container">';

                foreach ($typeAccess as $sub) {
                    if ($sub->parent == $taccess->id) {
                        if ($sub->grant == 1) {
                            $mchecked = "checked";
                        }else{
                            $mchecked = "";
                        }
                        $optionalItem .='<div class="container">
                            <label>
                                <input type="checkbox" '.$mchecked.' name="sub" value='.$sub->id.' id='.$id.' class="subm" >'.$sub->module_name.'
                            </label>
                        </div>';
                    }
                }
                $optionalItem .='</div';
           }

       }
        return $optionalItem;


    }

    public function editusertypes(Request $request){
        $module_id = $request->moduleid;
        $usertype_id = $request->usertypeid;
        $checked = $request->checked;

        $first = useraccess::where('module_id',$module_id)
                ->where('user_type_id',$usertype_id)
                ->first();
        if (!$first){
            if ($checked == "checked") {
                $newua = new useraccess;
                $newua->module_id = $module_id;
                $newua->user_type_id = $usertype_id;
                $newua->grant = 1;
                $newua->save();
            }else{
                $newua = new useraccess;
                $newua->module_id = $module_id;
                $newua->user_type_id = $usertype_id;
                $newua->grant = 0;
                $newua->save();
            }

        }else{

            if ($checked == "checked") {
                $edituseraccess = useraccess::where('module_id',$module_id)
                    ->where('user_type_id',$usertype_id)
                    ->get();


                    foreach ($edituseraccess as $eua) {
                        $id = $eua->id;
                        $editua = useraccess::find($id);
                        $editua->grant = 1;
                        $editua->save();
                    }
            }else{
                $edituseraccess = useraccess::where('module_id',$module_id)
                    ->where('user_type_id',$usertype_id)
                    ->get();

                    foreach ($edituseraccess as $neua){
                        $id1 = $neua->id;
                        $neditua = useraccess::find($id1);
                        $neditua->grant = 0;
                        $neditua->save();

                    }
            }
        }
    }
    public function getusertypeid($id){
        $result='';
        $result .='<input type="hidden" id="uid" value='.$id.'>';
        return $result;
    }

    public function deleteusertypes(Request $request){

        $userid = $request->userid;

        $deleteusertype = usertype::find($userid);
        $deleteusertype->delete();

        $useraccess = useraccess::where('user_type_id',$userid)->get();
        foreach ($useraccess as $ua) {
            $deleteua = useraccess::find($ua->id);
            $deleteua->delete();
        }

    }


}
