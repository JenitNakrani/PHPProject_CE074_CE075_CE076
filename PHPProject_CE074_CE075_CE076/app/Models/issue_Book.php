<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class issue_Book extends Model
{
    use HasFactory;
    public $timestamps = FALSE;
    public function book_id()
	{
	   return $this->hasMany(Book::class, 'id');
    }
}
