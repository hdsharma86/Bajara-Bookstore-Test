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

    /**
     * Component mount here
     * loading of all the books based on the auth check.
     */
    public function mount()
    {
        $this->loadBooks();
    }

    public function loadBooks(){
        $this->books = Book::all();
        if (Auth::check()) {
            $user = Auth::user()->load('books');
            $this->favBooks = $user->books;

            foreach($this->books as $book){
                if($this->isFavourite($book->id)){
                    $book->isFav = true;
                } else {
                    $book->isFav = false;
                }
            }
        }
    }

    public function isFavourite($bookId){
        $filteredArray = array_filter($this->favBooks->toArray(), function ($value) use ($bookId) {
            return $value['id'] === $bookId;
        });
        return count($filteredArray) > 0 ? true : false;
    }

    /**
     * Function to search & display books.
     */
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

    /**
     * Function to add any book into the favourite section.
     */
    public function addToFav($bookId){
        $userId = Auth::id();
        $user = User::find($userId);
        $user->books()->attach($bookId);
        $this->loadBooks();
    }

    public function removeFav($bookId){
        $userId = Auth::id();
        $user = User::find($userId);
        $user->books()->detach($bookId);
        $this->loadBooks();
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

    public function render()
    {
        return view('livewire.book-search');
    }
}
