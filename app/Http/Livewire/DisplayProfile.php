<?php

namespace App\Http\Livewire;

use Livewire\Component;

class DisplayProfile extends Component
{
    public $profile;

    public function mount()
    {
        if (auth()->user()->profile_photo != null)
            $this->profile = asset('images/' . auth()->user()->profile_photo);
    }

    public function render()
    {
        return view('livewire.display-profile');
    }
}
