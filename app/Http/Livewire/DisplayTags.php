<?php

namespace App\Http\Livewire;

use Livewire\Component;

class DisplayTags extends Component
{
    public $tags;

    public function mount($tags)
    {
        $this->tags = $tags;
    }

    public function render()
    {
        return view('livewire.display-tags');
    }
}
