<?php

namespace App\Http\Livewire;

use App\Models\Blog;
use Livewire\Component;

class DisplayFeaturedBlogs extends Component
{
    public $blogs = [];

    public function mount()
    {
        $this->blogs = Blog::all()->where('is_featured', true);
    }

    public function render()
    {
        return view('livewire.display-featured-blogs');
    }
}
