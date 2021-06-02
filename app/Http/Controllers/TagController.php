<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Facade\FlareClient\Http\Response;
use Illuminate\Http\Request;

class TagController extends Controller
{
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
}
