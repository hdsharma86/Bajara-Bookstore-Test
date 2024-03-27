<?php

namespace App\Livewire;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Login extends Component
{
    public $email;
    public $password;

    protected $rules = [
        'email' => 'required|email',
        'password' => 'required|min:3',
    ];

    public function render()
    {
        return view('livewire.login');
    }

    /**
     * Function to work with Authentication process here.
     */
    public function login()
    {
        $this->validate();

        $credentials = [
            'email' => $this->email,
            'password' => $this->password,
            'type' => 'user'
        ];

        if (Auth::attempt($credentials)) {
            // Authentication passed
            return redirect()->intended('/dashboard');
        } else {
            // Authentication failed
            session()->flash('error', 'Invalid credentials.');
        }
    }
}
