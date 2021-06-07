<?php

namespace App\Http\Livewire;

use Livewire\Component;

class DisplayProfile extends Component
{
    public $profile;
    public $userId;
    public $dimension;
    public $has_event;

    public function mount($user = null, int $dimension = 40, $has_event = true)
    {
        $user = $user ?? auth()->user();
        $this->dimension = $dimension;
        $this->has_event = $has_event;

        if ($user->profile_photo != null)
            $this->profile = asset('images/' . $user->profile_photo);
        $this->userId = $user->id;
    }

    public function render()
    {
        return view('livewire.display-profile');
    }
}
