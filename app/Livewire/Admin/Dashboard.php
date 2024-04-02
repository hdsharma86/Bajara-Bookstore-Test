<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Book;
use App\Models\User;

class Dashboard extends Component
{
    public $totalBooks;
    public $totalUsers;

    public function mount(){
        $this->totalBooks = Book::count();
        $this->totalUsers = User::where('type', 'user')->count();
    }

    public function render()
    {
        return view('livewire.admin.dashboard')->layout('components.layouts.admin.admin');
    }
}
