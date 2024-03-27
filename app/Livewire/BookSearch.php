<?php

namespace App\Livewire;
use App\Models\Book;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class BookSearch extends Component
{
    public $books;
    public $query;
    public $favBooks = [];

    public function mount()
    {
        $this->books = Book::all();
        if (Auth::check()) {
            $user = Auth::user()->load('books');
            $this->favBooks = $user->books;
        }
    }

    public function search(){
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
    }

    public function addToFav($bookId){
        $userId = Auth::id();
        $user = User::find($userId);
        $user->books()->attach($bookId);
    }

    public function redirectTo($path = '/'){
        return redirect()->intended('/book-detail');
    }

    public function render()
    {
        return view('livewire.book-search');
    }
}
