<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class issue_Book extends Model
{
    use HasFactory;
    public $timestamps = FALSE;

    public function Book()
    {
        return $this->belongsTo('App\Models\Book','book_id');
    }
    public function User()
    {
        return $this->belongsTo('App\Models\User','user_id');
    }
}
