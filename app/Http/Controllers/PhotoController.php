<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Photo;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class PhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function index()
    {
        return Photo::all();
    }

    /**
     * Store a newly created resource in storage.
     * Update the $model after photo creation.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Database\Eloquent\Model $model
     * @return \App\Models\Photo   $photo
     */
    public function store(Request $request, Model $model = null)
    {
        $request->validate([
            'photo' => 'image|mimes:jpg,jpeg,bmp,png|max:2048',
            'folder' => 'string|max:255',
            'filename' => 'string|max:255',
            'caption' => 'string|max:255',
        ]);

        $folder = 'defaults';
        $filename = 'default.png';
        $caption = '';

        if ($request->hasFile('photo')) {
            $folder = $request->folder;
            $file = $request->file('photo');
            $filename = $model->id . '/' . $file->getClientOriginalName();            
            $file->storeAs($folder, $filename);
            $caption = $request->caption;
        }

        $photo = Photo::create([
            'folder' => $folder,
            'filename' => $filename,
            'caption' => $caption
        ]);

        $foreign_id = '';
        if ($model instanceof User) {
            $foreign_id = 'profile_id';
        } else if ($model instanceof Blog) {
            $foreign_id = 'main_photo_id';
        } else {
            $foreign_id = 'photo_id';
        }
        
        $model->update([$foreign_id => $photo->id]);

        return $photo;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Photo  $photo
     * @param  \Illuminate\Database\Eloquent\Model $model
     * @return \Illuminate\Http\Response
     */
    public function destroy(Photo $photo, Model $model)
    {
        rmdir($model->id);
        $photo->delete();
    }
}
