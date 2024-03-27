<?php

namespace App\Livewire;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Profile extends Component
{
    public $name;
    public $email;
    public $password;

    // User registration validation rules
    protected $rules = [
        'name' => 'required|string|max:255'
    ];

    public function mount()
    {
        $this->name = Auth::user()->name;
        $this->email = Auth::user()->email;
    }

    public function profile(){

        $this->validate();

        Auth::user()->update([
            'name' => $this->name,
        ]);

        session()->flash('message', 'Profile updated successfully!');
    }

    public function render()
    {
        return view('livewire.profile');
    }
}
