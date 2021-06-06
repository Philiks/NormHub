<?php

namespace App\Services;

use App\Models\Blog;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Intervention\Image\Facades\Image;
use InvalidArgumentException;

class PhotoService
{
    const PROFILE_WIDTH = 240;
    const PROFILE_HEIGHT = 240;
    const BLOG_WIDTH = 360;
    const BLOG_HEIGHT = 300;

    /**
     * Store the uploaded photo on the filesystem disk.
     * 
     * @param Illuminate\Http\UploadedFile $photo
     * @param Illuminate\Database\Eloquent\Model $model
     * @param string $folder_name
     * 
     * @return void
     * 
     * @throws InvalidArgumentException
     */
    public function store(UploadedFile $photo, Model $model, string $folder_name)
    {
        if ($photo == null) return;

        if (!($model instanceof User || $model instanceof Blog))
            throw new InvalidArgumentException('$model is not an instance of User or Blog');
        
        $folder_name .= '/' . $model->id;
        $path = public_path('images/' . $folder_name);
        $photo->move($path, $photo->getClientOriginalName());
        $resized_photo = Image::make($path . '/' . $photo->getClientOriginalName());
        
        $field = '';
        if ($model instanceof User) {
            $field = 'profile_photo';
            $resized_photo->resize(PhotoService::PROFILE_WIDTH, PhotoService::PROFILE_HEIGHT)->save();
        } else if ($model instanceof Blog) {
            $field = 'main_photo';
            $resized_photo->resize(PhotoService::BLOG_WIDTH, PhotoService::BLOG_HEIGHT)->save();
        }

        $model->update([$field => $folder_name . '/' . $photo->getClientOriginalName()]);
    }
}