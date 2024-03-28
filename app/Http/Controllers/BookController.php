<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller
{
    /**
     * Function to return all books
     */
    public function index(){
        $books = Book::latest()->paginate(5);
        return $books;
    }

    /**
     * Api function to fetch a single book detail.
     */
    public function fetchBookDetail(){
        $id = request('id');
        $book = Book::where('id', $id)->get();
        return $book;
    }

    /**
     * Api to create a new book.
     */
    public function create(){
        return Book::create([
            'name' => request('name'),
            'description' => request('description'),
            'price' => request('price')
        ]);
    }

    /**
     * Api to update book here.
     */
    public function update(Book $book){
        return $book->update([
            'name' => request('name'),
            'description' => request('description'),
            'price' => request('price')
        ]);
    }

    /**
     * Function to delete book.
     */
    public function delete(Book $book){
        return $book->delete();
    }
}
