<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Book;
use App\Models\admin;
use App\Models\issue_Book;
use Illuminate\Database\Query\Builder;

use Auth;
use Hash;
use Crypt;
use Session;


class UserController extends Controller
{
    // Welcome Page
    function home(Request $req)
    {
        if($req->session()->get('uname')) {
            return redirect('login_welcome');
        } else {
            return view('home');
        }
    }

    // Login page for not superuser 
    function loginMember(Request $req)
    {
        if($req->isMethod('POST')) {
            if($req->session()->get('uname')) {
                return redirect('login_welcome');
            } else {
                $uname = $req->name;
                $upassword =  $req->password;
                $c = DB::table('users')->select('name')->where('name',$uname)->where('password',$upassword)->count();
                if ($c == 1){
                    $req->session()->put('uname',$uname);
                    return redirect('login_welcome');
                }
                else
                {
                    return redirect('mylogin')->with('message',"invalid username or password");
                }
            }
        } else {
            if($req->session()->get('uname')) {
                return redirect('login_welcome');
            } else {
                return view('mylogin');
            }
        }
    }
    
    // Register the user
    function addMember(Request $req)
     {
        $uname = $req->name;
        $upassword =  $req->password;
        $urepassword =  $req->repassword;
        $uemail=$req->email;
        if($upassword == $urepassword)
        {
            $c = DB::table('users')->select('name')->where('name',$uname)->count();
            $ec = DB::table('users')->select('name')->where('email',$uemail)->count();
            if($c == 0 )
            {
                if($ec==0)
                {
                    $user = new user;
                    $user->name = $req->name;
                    $user->firstname = $req->firstname;
                    $user->lastname = $req->lastname;
                    $user->email = $req->email;
                    $user->password = $req->password;
                    $user->save();
                    return redirect('mylogin');
                }
                else{
                    return redirect('myregister')->with('message',"Email alredy exists");    
                }
            }
            else{
                return redirect('myregister')->with('message',"username alredy exists");
            }
        }
        else{
            return redirect('myregister')->with('message',"password doesn't matched");
        }
    }

    // logout User
    function logoutMember(Request $req)
    {
        session()->forget('superuser');
        session()->flush();
        session()->forget('search');
        session()->flush();
        return redirect('/')->with('message',"Successfully Logout..");
    }

    function adminLogin(Request $req)
    {
        $aname = $req->aname;
        $apassword =  $req->apassword;
        $req->session()->put('aname',$aname);
        $c = DB::table('admins')->select('username')->where('username',$aname)->where('password',$apassword)->count();
        if ($c == 1){
            return redirect('admin_welcome');
        }
        else
        {
            return redirect('adminLogin')->with('message',"invalid username or password");
        }
    }
}
?>