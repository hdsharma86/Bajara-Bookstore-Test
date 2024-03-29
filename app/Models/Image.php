<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Book;

class Image extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'path'
    ];

    public function books(){
        return $this->belongsTo(Book::class, 'books_images_mapper', 'book_id', 'image_id')->withTimestamps();
    }
}
