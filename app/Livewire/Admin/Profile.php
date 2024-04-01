<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class Profile extends Component
{
    public $name;
    public $email;
    public $password;
    public $user;
    public $userId;

    protected function rules(){
        return [
            'name' => 'required|min:3',
            'email' => ['required', 'email', Rule::unique('users')->ignore($this->userId)]
        ];
    }

    public function updateProfile(){
        $this->validate();
        Auth::guard('admin')->user()->update([
            'name' => $this->name,
        ]);
        session()->flash('message', 'Profile updated successfully!');
    }

    public function mount()
    {
        $this->user = Auth::guard('admin')->user();
        $this->userId = $this->user->id;
        $this->name = $this->user->name;
        $this->email = $this->user->email;
    }

    public function render()
    {
        return view('livewire.admin.profile')->layout('components.layouts.admin.admin');
    }
}
