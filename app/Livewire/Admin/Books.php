<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Book;

class Books extends Component
{
    use WithPagination;
    public $bookData = [];
    public $perPage = 7;
    public $page = 1;

    public function getBooks(){
        $this->bookData = Book::latest()->paginate(5);
    }

    public function mount(){
        //$this->getBooks();
    }

    public function nextPage()
    {
        $this->page++;
    }

    public function previousPage()
    {
        if ($this->page > 1) {
            $this->page--;
        }
    }

    public function updateBook($id){
        return redirect()->route('livewire-admin.update-book', ['id' => $id]);
    }

    public function addBook(){
        return redirect()->route('livewire-admin.add-book');
    }

    public function deleteBook( $id ){
        $book = Book::find($id);
        $book->delete();
        session()->flash('message', 'Book deleted successfully!');
        $this->render();
    }

    public function render()
    {
        return view('livewire.admin.books', [
            'books' => Book::latest()->paginate($this->perPage, ['*'], 'page', $this->page)
        ])->layout('components.layouts.admin.admin');
    }
}
