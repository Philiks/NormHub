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

    public function mount($for = 'profile')
    {
        if (old('photo')) {
            $this->photo = old('photo');
            return;
        }

        $this->default_photo = $for == 'profile' ? 'profile.png' : 'blog.png';
        $this->border = $for == 'profile' ? 'rounded-full' : 'rounded-xl';
        $this->width = $for == 'profile' ? '200' : '300';
        $this->height = $for == 'profile' ? '200' : '250';
    }

    public function render()
    {
        return view('livewire.upload-image');
    }
}
