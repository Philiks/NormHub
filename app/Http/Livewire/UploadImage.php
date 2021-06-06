<?php

namespace App\Http\Livewire;

use App\Facades\Photo;
use Livewire\Component;
use Livewire\WithFileUploads;

class UploadImage extends Component
{
    use WithFileUploads;

    public $photo;
    public $default_photo;
    public $border;
    public $width;
    public $height;

    public function mount($default_photo, $is_round = true)
    {
        if (old('photo')) {
            $this->photo = old('photo');
            return;
        }

        $this->default_photo = $default_photo;
        $this->border = $is_round ? 'rounded-full' : 'rounded-xl';
        $this->width = $is_round ? '200' : '300';
        $this->height = $is_round ? '200' : '250';
    }

    public function render()
    {
        return view('livewire.upload-image');
    }
}
