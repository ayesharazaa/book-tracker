<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserBook extends Model
{
    
    protected $table = 'user_books';
    protected $fillable = ['user_id', 'book_id', 'status', 'current_page', 'start_date', 'finished_date'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}
