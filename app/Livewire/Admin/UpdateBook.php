<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Book;
use Illuminate\Support\Facades\Route;
use App\Models\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File; 

class UpdateBook extends Component
{
    use WithFileUploads;
    public $bookId;
    public $book;
    public $name;
    public $description;
    public $price;
    public $image;

    protected function rules(){
        return [
            'name' => 'required|min:3',
            'description' => 'required',
            'price' => 'required',
            //'image' => 'image|max:2048',
        ];
    }

    public function updatedImage()
    {
        $this->validateOnly('image');
    }

    public function updateBook(){
        $data = $this->validate();

        $dataArray = [
            'name' => $data['name'],
            'description' => $data['description'],
            'price' => $data['price']
        ];


        $imageName = '';
        if($this->image){
            $imageExtension = $this->image->extension();
            $imageName = time().'.'.$imageExtension;
        }
        
        $book = Book::with('images')->find($this->bookId);
        $book->update($dataArray);

        if(isset($book->images) && count($book->images) > 0){
            $image = Image::find($book->images[0]->id);
            if($this->image){
                if (File::exists(public_path('img')."/".$image->name)) {
                    File::delete(public_path('img')."/".$image->name);
                }
    
                $imageData = [
                    'name' => $imageName,
                    'path' => $imageName,
                ];
                $image->update($imageData);
                if($this->image){
                    $this->image->move(public_path('img'), $imageName);
                }
            }
        } else {
            if($this->image){
                $image = Image::create([
                    'name' => $imageName,
                    'path' => $imageName
                ]);
                $this->image->move(public_path('img'), $imageName);
                $book->images()->sync($image->id);
            }
        }

        session()->flash('message', 'Book updated successfully!');
        $this->reset();

        return redirect()->route('livewire-admin.books');
    }

    public function cancelUpdateBook(){
        $this->reset();
        return redirect()->route('livewire-admin.books');
    }

    public function mount(){
        $this->bookId = Route::current()->parameter('id');
        $this->book = Book::find($this->bookId);
        $this->name = $this->book->name;
        $this->description = $this->book->description;
        $this->price = $this->book->price;
    }

    public function render()
    {
        return view('livewire.admin.update-book')->layout('components.layouts.admin.admin');
    }
}
