<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Book;
use Illuminate\Http\Request;

class Home extends Component
{

    public function render()
    {
        return view('livewire.home');
    }
}
