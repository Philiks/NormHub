<?php

namespace App\Services;

use App\Models\Blog;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Intervention\Image\ImageManagerStatic as Image;
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
        
        $field = '';
        if ($model instanceof User) {
            $field = 'profile_photo';
            $width = PhotoService::PROFILE_WIDTH;
            $height = PhotoService::PROFILE_HEIGHT;
        } else if ($model instanceof Blog) {
            $field = 'main_photo';
            $width = PhotoService::BLOG_WIDTH;
            $height = PhotoService::BLOG_HEIGHT;
        }

        $filename = $model->id . '/' . $photo->getClientOriginalName();
        Image::make($photo->getRealPath())
            ->resize($width, $height)
            ->save(storage_path($folder_name, $filename));

        $model->update([$field => $folder_name . '/' . $filename]);
    }
}