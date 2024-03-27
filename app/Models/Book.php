<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price'
    ];

    public function images(){
        return $this->belongsToMany(Image::class, 'books_images_mapper', 'book_id', 'image_id')->withTimestamps();
    }

}
