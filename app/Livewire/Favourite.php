<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class Favourite extends Component
{
    public $books = [];

    public function mount(){
        $this->loadUserBooks();
    }

    /**
     * Redirection to any url.
     */
    public function redirectTo($id = null){
        if (Auth::check()) {
            return redirect()->to(route('book-detail',$id));
        } else {
            return redirect()->to(route('login'));
        }
    }

    public function loadUserBooks(){
        $userId = Auth::id();
        $user = User::find($userId);
        $this->books = $user->books;
    }

    public function removeFav($bookId){
        $userId = Auth::id();
        $user = User::find($userId);
        $user->books()->detach($bookId);
        $this->loadUserBooks();
    }

    public function render()
    {
        return view('livewire.favourite');
    }
}
