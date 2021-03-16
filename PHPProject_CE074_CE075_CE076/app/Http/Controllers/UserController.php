<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Book;
use App\Models\issue_Book;
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
        session()->forget('search');
        session()->flush();
        return redirect('/')->with('message',"Successfully Logout..");
    }

    function addBook(Request $req) {
        $book_name = $req->book_name;
        $author =  $req->author_name;
        $publish_year=$req->publish_year;
        
        $book = new book;
        $c = DB::table('books')->select('book_name')->where('book_name',$book_name)->where('author_name',$author)->where('publish_year',$publish_year)->count();
        if($c == 0)
        {
            $book->book_name = $book_name;
            $book->author_name = $author;
            $book->publish_year = $publish_year;
            $book->stock=1;
            $book->issued_book=0;
            $book->is_available=1;
            $book->save();
            return redirect('addbook')->with('message',"Successfully Book added.");    
        }
        else{
            DB::table('books')->where('book_name',$book_name)->where('author_name',$author)->where('publish_year',$publish_year)->increment('stock');
            DB::table('books')->where('book_name',$book_name)->where('author_name',$author)->where('publish_year',$publish_year)->increment('is_available');
            return redirect('addbook')->with('message',"Successfully Book added.");
        }
    }



    function removeBook(Request $req) {
        if($req->isMethod('POST')) {
            $book_id = $req->id;
            $c = DB::table('books')->where('id',$book_id)->value('stock');
            $avail = DB::table('books')->where('id',$book_id)->value('is_available');
            if($c == 1 && $avail == 1)
            {
                DB::delete("delete from books where id = $book_id");
            }
            elseif($c==1 && $avail ==0)
            {
                return redirect('removeBook')->with('message',"You can not delete this Book Because this book is already given.");
            }
            elseif($avail==0)
                return redirect('removeBook')->with('message',"You can not delete this Book Because this book is already given.");
            else{
                DB::table('books')->where('id',$book_id)->decrement('stock');
                DB::table('books')->where('id',$book_id)->decrement('is_available');        
            }
            $books = DB::table('books')->get();
            return view('removebook', ['books' => $books]);
        } else {
            $search_query=$req->input_query;
            $option=$req->option;
            $req->session()->put('search',$search_query);
            if($option == "all") 
                $books=Book::where('book_name', 'LIKE', "%{$search_query}%") ->orWhere('author_name', 'LIKE', "%{$search_query}%") -> orWhere('publish_year','LIKE',"%{$search_query}%") -> get();
            elseif($option == "book_name") 
                $books=Book::where('book_name', 'LIKE', "%{$search_query}%")-> get();
            elseif($option == "author_name") 
                $books=Book::where('author_name', 'LIKE', "%{$search_query}%")->get();
            else
                $books=Book::where('publish_year','LIKE',"%{$search_query}%") -> get();
            return view('removebook', ['books' => $books]);
        }
    }

//************************************************************************************************************************** */
    
    function issueBook(Request $req) {
        if($req->isMethod('POST')) {
            $book_id = $req->id;
            $uname=$req->session()->get('uname');
            $issue_books =new issue_book;
            $c = DB::table('books')->where('id',$book_id)->value('stock');
            $avail = DB::table('books')->where('id',$book_id)->value('is_available');
            $user_id=DB::table('users')->where('name',$uname)->value('id');
            $user_count=DB::table('issue__books')->select('user_id')->where('user_id',$user_id)->count();
            if($user_count<3)
            {
                if($avail>0)
                {
                    DB::table('books')->where('id',$book_id)->decrement('is_available');
                    DB::table('books')->where('id',$book_id)->increment('issued_book');
                    $issue_books->book_id=$book_id;
                    $issue_books->user_id=$user_id;
                    $issue_books->save();
                }
            }
            else{
                $books = DB::select("SELECT * from books where is_available>0");
                return redirect('issuebook')->with(['books' => $books])->with('message',"You have already issued 3 Books.");
            } 
            $books = DB::select("SELECT * from books where is_available>0");
            return view('issuebook', ['books' => $books]);
        }
        else {
            $search_query=$req->input_query;
            $option=$req->option;
            if($option == "all") 
                $books=Book::where('book_name', 'LIKE', "%{$search_query}%") ->orWhere('author_name', 'LIKE', "%{$search_query}%") -> orWhere('publish_year','LIKE',"%{$search_query}%") -> get();
            elseif($option == "book_name") 
                $books=Book::where('book_name', 'LIKE', "%{$search_query}%")-> get();
            elseif($option == "author_name") 
                $books=Book::where('author_name', 'LIKE', "%{$search_query}%")->get();
            else
                $books=Book::where('publish_year','LIKE',"%{$search_query}%") -> get();
            return view('issuebook', ['books' => $books]);
        }
    }
}