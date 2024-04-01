<?php

namespace App\Livewire\Admin;
use Livewire\Component;
use App\Models\User;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Redirect;

class Users extends Component
{
    use WithPagination;
    public $userData = [];
    public $perPage = 7;
    public $page = 1;

    public function getUsers(){
        $this->userData = User::where('type', 'user')->latest()->paginate(5);
    }

    public function mount(){
        //$this->getUsers();
    }

    public function nextPage()
    {
        $this->page++;
    }

    public function previousPage()
    {
        if ($this->page > 1) {
            $this->page--;
        }
    }

    public function updateUser($uid){
        return redirect()->route('livewire-admin.update-user', ['id' => $uid]);
    }

    public function addUser(){
        return redirect()->route('livewire-admin.add-user');
    }

    public function deleteUser( $uid ){
        $user = User::find($uid);
        $user->delete();
        session()->flash('message', 'User deleted successfully!');
        $this->render();
    }

    public function render()
    {
        return view('livewire.admin.users', [
            'users' => User::where('type', 'user')->latest()->paginate($this->perPage, ['*'], 'page', $this->page)
        ])->layout('components.layouts.admin.admin');
    }
}
