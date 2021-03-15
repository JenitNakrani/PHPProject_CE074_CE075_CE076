<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Book;
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
        $checkbox=$req->checkbox;
        $super_name="admin";
        $super_pass="admin";
        error_log($checkbox);
        if($checkbox != "superuser")
        {
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
        else{
            if ($uname == $super_name and $upassword == $super_pass)
            {  
                 $req->session()->put('superuser',TRUE);
                return redirect('login_welcome')->with('message',"invalid username or password");
            }
                else
                return redirect('mylogin')->with('message',"Invalid Username or Password of Superuser");
        }
    }

    function logoutMember(Request $req)
    {
        session()->forget('superuser');
        session()->flush();
        return redirect('/')->with('message',"Successfully Logout..");
    }

    function addBook(Request $req) {
        $book_name = $req->book_name;
        $author =  $req->author_name;
        $publish_year=$req->publish_year;
        
        $book = new book;

        $book->book_name = $book_name;
        $book->author_name = $author;
        $book->publish_year = $publish_year;
        $book->is_available = TRUE;
        $book->save();
        return redirect('addbook')->with('message',"Successfully Book added.");
    }

    function removeBook(Request $req) {
        if($req->isMethod('POST')) {
            $book_id = $req->id;
            // $book_object = DB::table('books')->where('id',$book_id);
            // $book_object->delete();
            DB::delete("delete from books where id = $book_id");
            $books = DB::table('books')->get();
            return view('removebook', ['books' => $books]);
        } else {
            $books = DB::table('books')->get();
            return view('removebook', ['books' => $books]);
        }
    }

}
