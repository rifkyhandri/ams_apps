<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Models\Menu;
use App\Models\User;
use App\Models\Usermenu;
use Carbon\Carbon;

class RoleController extends Controller
{
    //

    
    public function listmenu(Request $request){
        $dataId = $request->id;
        //dd($dataId);
        $dataArray = [];
        $menutampil = Usermenu::where('user_id',$dataId)->get();
        for ($i=0; $i <count($menutampil) ; $i++) { 
            # code...
            $dataArray[] =  $menutampil[$i]['menu_id'];
        }
        

        $menu = Menu::whereNotIn('id',$dataArray)->get();
        //return response()->json($menu);
        return Datatables::of($menu)->make(true);
    }
    public function edit_menu(Request $request){
        
        $menu = Menu::where('id',$request->id)->get();
        return response()->json($menu);
        // return Datatables::of($menu)->make(true);
    }
    
    public function role_list(){
        $usermenu = Usermenu::get()
        ->map(function($key){
            return [

                'id' => $key->id,
                'userId' => $key->user_id,
                'user'   => $key->user->name,
                'menuId' => $key->menu->id,
                'menu'   => $key->menu->menu,
                'create' => $key->create,
                'read'   => $key->read,
                'update' => $key->update,
                'delete' => $key->delete,
                'date'   => $key->created_at->format('d-M-y'),
            ];
        });
        return Datatables::of($usermenu)->make(true);
    }

    public function role_input(Request $request){
            //dd($request);
            
            $role           = new Usermenu;
            $role->user_id  = $request->user;
            $role->menu_id  = $request->menu;
            $role->create   = $request->create;
            $role->read     = $request->read;
            $role->crud     = $request->create.$request->read.$request->update.$request->del;
            $role->update   = $request->update;
            $role->delete   = $request->del;
            $role->save(); 
            
            
        
    }

    public function role_edit(Request $request){
        $usermenu = Usermenu::where('user_id',$request->id)->get()
        ->map(function($key){

            if ($key->read == "R") {
                $read = 'checked="checked"';
            }else{
                $read = "";
            }

            if ($key->create == "C") {
                $create = 'checked="checked"';
            }else{
                $create = "";
            }
            if ($key->update == "U") {
                $update = 'checked="checked"';
            }else{
                $update = "";
            }
            if ($key->delete == "D") {
                $delete = 'checked="checked"';
            }else{
                $delete = "";
            }
            return [

                'id'     => $key->id,
                'userId' => $key->user_id,
                'user'   => $key->user->name,
                'email'  => $key->user->email,
                'note'   => $key->user->note,
                'menuId' => $key->menu->id,
                'menu'   => $key->menu->menu,
                'create' => $create,
                'read'   => $read,
                'update' => $update,
                'delete' => $delete,
                'date'   => $key->created_at->format('d-M-y'),
            ];
        });
        return response()->json($usermenu);
    }

    public function role_update(Request $request){
        //dd($request);
            $role           = Usermenu::find($request->editId);
            $role->user_id  = $request->user;
            $role->menu_id  = $request->menu;
            $role->create   = $request->create;
            $role->read     = $request->read;
            $role->crud     = $request->create.$request->read.$request->update.$request->del;
            $role->update   = $request->update;
            $role->delete   = $request->del;
            $role->save(); 
                

    }
    public function role_delete(Request $request){
        //dd($request);
        
        /* $id = request()->input('id'); */
        $role  = Usermenu::find($request->id);
        $role->delete();
    }
    
    
}
