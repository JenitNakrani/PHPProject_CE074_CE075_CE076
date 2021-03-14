<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Reader;

class UserController extends Controller
{
    
    function addMember(Request $req)
    {
        $uname = $req->username;
        $upassword =  $req->password;
        $urepassword =  $req->repassword;
        if($upassword == $urepassword)
        {
            $c = DB::table('readers')->where('username',$uname)->count();
            if($c == 0 )
            {
                $reader = new Reader;
                $reader->username = $req->username;
                $reader->firstname = $req->firstname;
                $reader->lastname = $req->lastname;
                $reader->email = $req->email;
                $reader->password = $req->password;
                $reader->save();
                return redirect('mylogin');
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
        $uname = $req->username;
        $upassword =  $req->password;
        $c = DB::table('readers')->where('username',$uname and 'password',$upassword)->count();
        if($c == 1)
        {
            return redirect('temp');
        }
        else
        {
            return redirect('mylogin')->with('message',"invalid username or password");
        }
    }
}
