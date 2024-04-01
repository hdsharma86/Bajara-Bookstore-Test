<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Login extends Component
{
    public $email;
    public $password;

    protected $rules = [
        'email' => 'required|email',
        'password' => 'required|min:3',
    ];

    /**
     * Function to work with Authentication process here.
     */
    public function login()
    {
        $this->validate();

        $credentials = [
            'email' => $this->email,
            'password' => $this->password,
            'type' => 'admin'
        ];

        if (Auth::guard('admin')->attempt($credentials)) {
            // Authentication passed
            return redirect()->intended('/livewire-admin/users');
        } else {
            // Authentication failed
            session()->flash('error', 'Invalid credentials.');
        }
    }

    /**
     * User logout here
     */
    public function adminLogout(){
        if(Auth::guard('admin')->check()) {
            //dd("Test2");
            Auth::guard('admin')->logout();
            return redirect()->route('livewire-admin.login');
        }
        //return redirect()->intended('/livewire-admin/login');
    }

    public function mount(){
        
    }

    public function render()
    {
        return view('livewire.admin.login')->layout('components.layouts.admin.default');
    }
}
