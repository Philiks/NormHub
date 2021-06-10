<?php

namespace App\Http\Controllers;

use App\Facades\Photo;
use App\Facades\Story;
use App\Models\Blog;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('blog.story-write');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'string|max:255',
            'content' => 'string',
            'tags' => 'string|max:255',
        ]);

        $blog = Blog::create([
            'author_id' => auth()->user()->id,
            'title' => $request->title,
            'is_featured' => $request->is_featured ?? false,
            'content' => $request->content,
        ]);

        Story::compute_read_time($request->content, $blog);
        Story::sync_tags($request->tags, $blog);
        
        if ($request->hasFile('photo'))
            Photo::store($request->file('photo'), $blog, 'blogs');
        
        return redirect(RouteServiceProvider::HOME);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Contracts\View\View
     */
    public function show(Blog $blog)
    {
        return view('blog.story-read')->with('blog', $blog);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(Blog $blog)
    {
        return view('blog.story-edit')->with('blog', $blog);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Blog $blog)
    {
        $request->validate([
            'title' => 'string|max:255',
            'is_featured' => 'boolean',
            'content' => 'string',
            'tags' => 'string|max:255',
        ]);

        $blog->update([
            'author_id' => auth()->user()->id,
            'title' => $request->title,
            'is_featured' => $request->is_featured ?? $blog->is_featured,
            'content' => $request->content,
        ]);

        Story::compute_read_time($request->content, $blog);
        Story::sync_tags($request->tags, $blog);
        if ($request->has('photo') && 
            $request->file('photo')->getClientOriginalName() != explode('/', $blog->main_photo)[2]) // [0]profiles [1]id [2]name
            Photo::store($request->file('photo'), $blog, 'blogs');
        
        return redirect()->route('blog.show', $blog->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy(Blog $blog)
    {
        $blog->delete();
        return redirect()->route('user.show', auth()->user()->id);
    }
}
