<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Book;

class BookDetail extends Component
{
    public $id;
    public $book;

    public function mount($id){
        $this->id = $id;
        $this->loadBookDetail();
    }

    public function loadBookDetail(){
        $this->book = Book::find($this->id);
    }

    public function render()
    {
        return view('livewire.book-detail');
    }
}
