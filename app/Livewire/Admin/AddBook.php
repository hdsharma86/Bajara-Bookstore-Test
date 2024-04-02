<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Book;
use App\Models\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class AddBook extends Component
{
    use WithFileUploads;
    public $name;
    public $description;
    public $price;
    public $image;

    protected function rules(){
        return [
            'name' => 'required|min:3',
            'description' => 'required',
            'price' => 'required',
            'image' => 'image',
        ];
    }

    public function updatedImage()
    {
        $this->validateOnly('image');
    }

    public function saveBook(Request $request){

        $data = $this->validate();

        if($this->image){
            $imageExtension = $this->image->extension();
            $imageName = time().'.'.$imageExtension;
        }
        
        if($this->image){
            try {
                $this->image->storeAs('img', $imageName);
            } catch (\Exception $e) {
                dd($e->getMessage());
            }
        }

        $image = Image::create([
            'name' => $imageName,
            'path' => $imageName
        ]);

        $book = Book::create([
            'name' => $data['name'],
            'description' => $data['description'],
            'price' => $data['price']
        ]);

        $book->images()->sync($image->id);

        session()->flash('message', 'Book added successfully!');
        $this->reset();

        return redirect()->route('livewire-admin.books');
    }

    public function cancelAddBook(){
        $this->reset();
        return redirect()->route('livewire-admin.books');
    }

    public function render()
    {
        return view('livewire.admin.add-book')->layout('components.layouts.admin.admin');
    }
}
