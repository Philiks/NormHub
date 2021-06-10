<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;

class ManageUsers extends Component
{
    public $users = [];

    public function mount() {
        $this->users = User::all()->where('is_admin', false);
    }

    public function render()
    {
        return view('livewire.manage-users');
    }
}
