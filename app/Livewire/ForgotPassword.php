<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;

class ForgotPassword extends Component
{
    public $email;

    protected function rules(){
        return [
            'email' => ['required', 'email']
        ];
    }

    public function forgotPassword(){
        $this->validate();
    }

    public function render()
    {
        return view('livewire.forgot-password');
    }
}
