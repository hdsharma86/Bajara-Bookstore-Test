<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\User;
use App\Rules\UniqueEmail;

class AddUser extends Component
{
    public $name;
    public $email;
    public $password;

    protected function rules(){
        return [
            'name' => 'required|min:3',
            'email' => ['required', 'email', new UniqueEmail()],
            'password' => 'required|min:5',
        ];
    }

    public function cancelAddUser(){
        $this->reset();
        return redirect()->route('livewire-admin.users');
    }

    public function saveUser(){
        $data = $this->validate();
        
        User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password'])
        ]);

        session()->flash('message', 'User added successfully!');
        $this->reset();

        return redirect()->route('livewire-admin.users');
    }

    public function render()
    {
        return view('livewire.admin.add-user')->layout('components.layouts.admin.admin');
    }
}
