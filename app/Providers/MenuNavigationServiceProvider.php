<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\User;
use App\Module;
use App\submodules;

class MenuNavigationServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
       // view()->composer('layouts.app', function($view) {
       //      $user = Auth::id();
       //      $getName = User::find($user);

       //      $userac = User::where('user_type_id',1)
       //          ->where('id',$user)
       //          ->get();

       //      $count = count($userac);
       //      $modules = Modules::where('routes','!=','modules')
       //          ->where('routes','!=','addmodules')
       //          ->get();  
       //      $a ='';
       //      foreach ($modules as $s) {
       //      $a = Modules::where('hasSubmodule',0)
       //          ->where('parent',$s->parent)
       //          ->get();
               
       //      }

       //      $view->with('count', $count)
       //          ->with('modules', $modules)
       //          ->with('a', $a);
       //  });
        view()->composer('layouts.app', function($view) {
            $userid = Auth::id();
            $getName = User::find($userid);

            $userac = User::where('id',$userid)
                ->get();

            $count = count($userac);
            $modules = Module::select('modules.id', 'modules.name', 'modules.icon', 'modules.routes', 'modules.icon', 'modules.parent', 'modules.has_sub')->leftjoin('user_access as ua', 'modules.id', '=', 'ua.module_id')->where('grant', 1)->where('visible', 1)->get();  
        // dd($modules);

            $view->with('modules', $modules);
                
        });
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
