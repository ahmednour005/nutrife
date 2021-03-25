<?php

namespace App\Http\Controllers;

use App\Leads;
use App\Role;
use App\Shipping;
use App\User;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function home(){
        $users = User::all();
        $leads = Leads::all();
        $shippings = Shipping::all();
        return view('home')->with(['users'=>$users , 'leads'=>$leads,'shippings'=>$shippings]);
    }

    public function index()
    {

//        return  DB::select('select * from roles where name="Admin"');
        $callcenter = Role::find(4);
        $callcenterleader = Role::find(1);
        $admin = Role::find(5);
        $users = $callcenter->users;
        $get_admin = $admin->users;
        $get_callcenterleader = $callcenterleader->users;
//        $user = Auth::user()->name;
//        $userselect = DB::select('select * from leads where Employee_Name ="'.$user.'"');
        return view('leads')->with(['users'=>$users,
            'get_admin'=>$get_admin,'get_callcenterleader'=>$get_callcenterleader ]);
    }
}
