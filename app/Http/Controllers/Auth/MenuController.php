<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\User;
use App\Models\Usermenu;


class MenuController extends Controller
{
    //

    public function listmenu(){
        $menu = Menu::all();

        return response()->json($menu);
    }
}
