<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * The "type" of the primary key ID.
     * The "type" is string because it uses 
     * Illuminate\Support\Str::uuid()->toString()
     * for the primary key ID.
     *
     * @var string
     */
    protected $keyType = 'string';

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * Bootstrap the model and its traits.
     * 
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        /**
         * Create the primary key UUID.
         */
        static::creating(function ($post) {
            $post->{$post->getKeyName()} = Str::uuid()->toString();
        });
    }

    /**
     * The attributes that are mass assignable.
     * 
     * @var array
     */
    protected $fillable = [
        'content',
        'like_count',
        'comment_count',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    /**
     * Method for accessing comments from one-to-many relationship
     * using pivot table comment_comment.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function comments()
    {
        return $this->belongsToMany(Comment::class);
    }
}
