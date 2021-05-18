<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Photo;
use App\Models\Tag;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Blog::with('comments')->with('tags')->get()->paginate(6);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('blog-write');
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
            'is_featured' => 'boolean',
            'content' => 'string',
            'tags' => 'string|max:255',
        ]);

        // Source: https://scholarwithin.com/average-reading-speed
        // Took the average of 200 and 350 (college and adult range).
        $AVERAGE_WORD_PER_MINUTE = 275;
        $read_time = count(explode(' ', $request->content)) / $AVERAGE_WORD_PER_MINUTE;

        $blog = Blog::create([
            'author_id' => auth()->user()->id,
            'title' => $request->title,
            'is_featured' => $request->is_featured ?? true,
            'content' => $request->content,
            'read_time' => $read_time,
        ]);

        $request->request->add([
            'folder' => 'blogs/' . auth()->user()->id, 
            'caption' => 'blog thumbnail']);
        (new PhotoController)->store($request, $blog);

        $tags = explode(',', $request->tags);
        $tags_final = [];
        foreach ($tags as $tag) {
            $filtered_tag = Tag::firstOrCreate(['title' => $tag]);
            array_push($tags_final, $filtered_tag->id);
        }

        $blog->tags()->sync($tags_final);

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
        return view('blog-read')->with('blog', $blog);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(Blog $blog)
    {
        return view('blog-write')->with($blog);
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

        // Source: https://scholarwithin.com/average-reading-speed
        // Took the average of 200 and 350 (college and adult range).
        $AVERAGE_WORD_PER_MINUTE = 275;
        $read_time = count(explode(' ', $request->content)) / $AVERAGE_WORD_PER_MINUTE;

        $blog->update([
            'title' => $request->title,
            'is_featured' => $request->is_featured,
            'content' => $request->content,
            'read_time' => $read_time,
        ]);

        if ($blog->main_photo_id != $request->main_photo_id) {
            // Deletion.
            $photo = Photo::find($request->main_photo_id);
            (new PhotoController)->delete($photo, $blog);

            // Creation.
            $request->request->add([
                'folder' => 'blogs', 
                'caption' => 'blog thumbnail']);
            (new PhotoController)->store($request, $blog);
        }

        $blog->tags()->sync(explode(',', $request->tags));

        return redirect(RouteServiceProvider::HOME);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy(Blog $blog)
    {
        //
    }
}
