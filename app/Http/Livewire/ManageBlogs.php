<?php

namespace App\Http\Livewire;

use App\Models\Blog;
use Livewire\Component;
use App\Models\User;

class ManageBlogs extends Component
{
    public $blogs = [];

    public function mount() {
        foreach (User::all() as $user)
            foreach ($user->blogs as $blog)
                $this->blogs = array_merge($this->blogs, [$blog->id => $blog]);
    }

    public function render()
    {
        return view('livewire.manage-blogs');
    }

    public function setFeature($blogId)
    {
        $blog = Blog::find($blogId);
        $blog->update(['is_featured' => !$blog->is_featured]);
        $this->blogs[$blog->id] = $blog;
    }
}
