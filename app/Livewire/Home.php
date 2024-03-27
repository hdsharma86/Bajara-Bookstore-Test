<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Book;
use Illuminate\Http\Request;

class Home extends Component
{
    //public $books;
    //public $query;
    public function mount()
    {
        //$this->books = Book::all();
    }

    /*public function search(){
        $inputQuery = $this->query;
        $books = Book::query()
        ->when($inputQuery, function ($query) use ($inputQuery) {
            if($inputQuery !== ''){
                return $query->where('name', 'LIKE', "%$inputQuery%")
                        ->orWhere('description', 'LIKE', "%$inputQuery%");
            }
        })
        ->orderBy('id', 'DESC')
        ->get();
        $this->books = $books;
        return $this->books;
    }*/

    public function render()
    {
        return view('livewire.home');
    }
}
