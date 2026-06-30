<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo; 



class Book extends Model
{
    
    protected $fillable = ['title', 'author', 'published_year', 'genre_id', 'description', 'cover_image', 'pages'];
    public function genre(): BelongsTo
    {
        return $this->belongsTo(Genre::class);
    }

    public function userBooks()
    {
        return $this->hasMany(UserBook::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_books')
                    ->withPivot('status', 'current_page', 'start_date', 'finished_date')
                    ->withTimestamps();
    }
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
