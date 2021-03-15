<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\user;
use Auth;
use Hash;
use Crypt;
use Session;
use Illuminate\Database\Query\Builder;

class UserController extends Controller
{
    
    function addMember(Request $req)
     {
        $uname = $req->username;
        $upassword =  $req->password;
        $urepassword =  $req->repassword;
        $uemail=$req->email;
        if($upassword == $urepassword)
        {
            $c = DB::table('users')->where('name',$uname)->count();
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

    function loginMember(Request $req)
    {
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
    function logoutMember(Request $req)
    {
        return redirect('/')->with('message',"Successfully Logout..");
    }
}
