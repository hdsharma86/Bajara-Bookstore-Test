<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\User;
use App\Rules\UniqueEmail;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\Rule;

class UpdateUser extends Component
{
    public $user;
    public $userId;
    public $name;
    public $email;
    public $password;

    protected function rules(){
        return [
            'name' => 'required|min:3',
            'email' => ['required', 'email', Rule::unique('users')->ignore($this->userId),]
        ];
    }

    public function updateUser(){
        $data = $this->validate();

        $dataArray = [
            'name' => $data['name'],
            'email' => ($this->user->email !== $data['email']) ? $data['email'] : $this->user->email,
            'password' => isset($data['password']) ? bcrypt($data['password']) : $this->user->password
        ];

        $user = User::find($this->userId);
        $user->update($dataArray);

        session()->flash('message', 'User added successfully!');
        $this->reset();

        return redirect()->route('livewire-admin.users');
    }

    public function cancelUpdateUser(){
        $this->reset();
        return redirect()->route('livewire-admin.users');
    }

    public function mount(){
        $this->userId = Route::current()->parameter('id');
        $this->user = User::find($this->userId);
        $this->name = $this->user->name;
        $this->email = $this->user->email;
    }

    public function render()
    {
        return view('livewire.admin.update-user')->layout('components.layouts.admin.admin');
    }
}
