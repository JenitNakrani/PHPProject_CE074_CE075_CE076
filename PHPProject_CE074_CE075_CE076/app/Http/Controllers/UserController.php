<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reader;

class UserController extends Controller
{
    function addMember(Request $req)
    {
        $reader = new Reader;
        $reader->username = $req->username;
        $reader->firstname = $req->firstname;
        $reader->lastname = $req->lastname;
        $reader->email = $req->email;
        $reader->password = $req->password;
        $reader->save();
        return redirect('myregister');
    }
}
