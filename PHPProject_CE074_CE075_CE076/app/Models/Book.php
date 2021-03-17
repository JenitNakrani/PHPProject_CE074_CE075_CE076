<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    public $timestamps = FALSE;
    
    public function issue_Book()
    {
        return $this->hasMany('App\Models\issue_Book');
    }
}
