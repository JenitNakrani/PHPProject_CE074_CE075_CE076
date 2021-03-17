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

class BookController extends Controller
{
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
            if($c == 1 and $avail == 1)
            {
                DB::delete("delete from books where id = $book_id");
            }
            elseif($c==1 and $avail ==0)
            {
                return redirect('removebook')->with('message',"You can't delete this Book Because this book is already given.");
            }
            elseif($avail==0)
                return redirect('removebook')->with('message',"You can't delete this Book Because this book is already given.");
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
                    $issue_books->book_id=$book_id;
                    $issue_books->user_id=$user_id;
                    $issue_books->issued_date=date('Y-m-d');
                    $issue_books->save();
                    DB::table('books')->where('id',$book_id)->decrement('is_available');
                    DB::table('books')->where('id',$book_id)->increment('issued_book');
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
            elseif($option == "publish_year")
                $books=Book::where('publish_year','LIKE',"%{$search_query}%") -> get();
            else
                $books = DB::select("SELECT * from books where is_available>0");
            return view('issuebook', ['books' => $books]);
        }
    }

    function returnBook(Request $req) {
        if($req->isMethod('POST')) {
            
            $issue_id = $req->id;
            $uname=$req->session()->get('uname');
            $book_id=$req->book_id;
            $issue_books =new issue_book;$user_id=DB::table('users')->where('name',$uname)->value('id');
            DB::delete("delete from issue__books where id=$issue_id");
            DB::table('books')->where('id',$book_id)->increment('is_available');
            DB::table('books')->where('id',$book_id)->decrement('issued_book');
            $books=issue_book::where('user_id',$user_id)->with('book')->get();
            return view('returnbook', ['books' => $books]);
        }
        else {
            $uname = $req->session()->get('uname');
            $user_id=DB::table('users')->where('name',$uname)->value('id');
            $books=issue_book::where('user_id',$user_id)->with('book')->get();
            return view('returnbook', ['books' => $books]);
        }
    }
}

?>