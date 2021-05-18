<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Facade\FlareClient\Http\Response;
use Illuminate\Http\Request;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function index()
    {
        return Tag::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \App\Models\Tag  $tag
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'string|max:255',
        ]);

        $tag = Tag::create(['title' => $request->title]);
        
        return $tag;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tag  $tag
     * @return \App\Models\Tag  $tag
     */
    public function show(Tag $tag)
    {
        return $tag;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tag $tag)
    {
        $tag->delete();

        return back();
    }
}
