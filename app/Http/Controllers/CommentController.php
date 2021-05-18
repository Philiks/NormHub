<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Comment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function index()
    {
        return Comment::with('comments')->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Database\Eloquent\Model $model
     * @return \App\Models\Comment  $comment
     */
    public function store(Request $request, Model $model)
    {
        $request->validate([
            'content' => 'string',
        ]);

        $comment = Comment::create(['content' => $request->content]);
        
        if ($model instanceof Blog || $model instanceof Comment) {
            $model->comments()->attach($comment->id);
            $model->update(['comment_count' => $model->comment_count + 1]);
        }

        return $comment;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function show(Comment $comment)
    {
        return $comment->with('comments')->get();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Comment  $comment
     * @return \App\Models\Comment  $comment
     */
    public function update(Request $request, Comment $comment)
    {
        $request->validate([
            'content' => 'string',
            'like_count' => 'integer|size:1',
        ]);

        $comment->update([
            'content' => $request->content,
            'like_count' => $comment->like_count + $request->like_count
        ]);

        return $comment;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        $comment->delete();

        return back();
    }
}
