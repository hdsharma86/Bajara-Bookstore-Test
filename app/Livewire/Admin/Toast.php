<?php

namespace App\Livewire\Admin;
use Livewire\Component;

class Toast extends Component
{
    public $message;
    public $isShown = false;
    protected $listeners = ['Toast'];

    public function showToast($message)
    {
        $this->message = $message;
        $this->isShown = true;
        $this->dispatch('Toast');
    }

    public function render()
    {
        return view('livewire.admin.toast');
    }
}
