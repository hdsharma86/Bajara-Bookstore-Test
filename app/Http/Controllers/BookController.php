<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Image;
use Illuminate\Support\Facades\File; 

class BookController extends Controller
{
    /**
     * Function to return all books
     */
    public function index(){
        $books = Book::with('images')->latest()->paginate(5);
        return $books;
    }

    /**
     * Api function to fetch a single book detail.
     */
    public function fetchBookDetail(){
        $id = request('id');
        $book = Book::with('images')->where('id', $id)->get();
        return response()->json($book);
    }

    /**
     * Api to create a new book.
     */
    public function create(Request $request){
        $imageName = '';
        if($request->file){
            $imageExtension = $request->file->extension();
            $imageName = time().'.'.$imageExtension;
        }

        if($request->file){
            $request->file->move(public_path('img'), $imageName);
        }

        $image = Image::create([
            'name' => $imageName,
            'path' => $imageName
        ]);

        $book = Book::create([
            'name' => request('name'),
            'description' => request('description'),
            'price' => request('price')
        ]);

        $book->images()->sync($image->id);

        return $book;
    }

    /**
     * Api to update book here.
     */
    public function update(Request $request, $id){
        $imageName = '';
        if($request->file){
            $imageExtension = $request->file->extension();
            $imageName = time().'.'.$imageExtension;
        }
        
        $book = Book::with('images')->find($id);
        $bookPayload = [
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price
        ];
        
        $book->update($bookPayload);

        if(isset($book->images) && count($book->images) > 0){
            $image = Image::find($book->images[0]->id);
            if($request->hasFile('file')){
                if (File::exists(public_path('img')."/".$image->name)) {
                    File::delete(public_path('img')."/".$image->name);
                }
    
                $imageData = [
                    'name' => $imageName,
                    'path' => $imageName,
                ];
                $image->update($imageData);
                if($request->file){
                    $request->file->move(public_path('img'), $imageName);
                }
            }
        } else {
            if($request->hasFile('file')){
                $image = Image::create([
                    'name' => $imageName,
                    'path' => $imageName
                ]);
                $request->file->move(public_path('img'), $imageName);
                $book->images()->sync($image->id);
            }
        }

        return $book;
    }

    /**
     * Function to delete book.
     */
    public function delete(Book $book){
        return $book->delete();
    }
}
