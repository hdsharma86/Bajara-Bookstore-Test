<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Logout extends Component
{

    /**
     * User logout here
     */
    public function logout(){
        Auth::guard('admin')->logout();
        return redirect()->route('livewire-admin.login');
        //return redirect()->intended('/livewire-admin/login');
    }

    public function render()
    {
        return view('livewire.admin.logout');
    }
}
