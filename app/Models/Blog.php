<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
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
        'author_id',
        'title',
        'main_photo',
        'is_featured',
        'content',
        'read_time',
        'tag_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        /* 
        'created_at' is the same with blog 
        published date so don't hide it.
        */
        'updated_at',
    ];

    /**
     * Method for accessing tags from many-to-many relationship
     * using pivot table blog_tag.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    /**
     * Method for accessing comments from one-to-many relationship
     * using pivot table blog_comment.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * Method for accessing auther from many-to-one relationship 
     * from table users.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function author()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Method for turning read time into words.
     * 
     * @return string
     */
    public function read_time_str()
    {
        if ($this->read_time == 0)
            return 'less than a minute of reading';
        else if ($this->read_time == 1)
            return 'a minute of reading';
        else
            return $this->read_time . ' minutes of reading';
    }

    /**
     * Method for formatting content. Specifically replacing '\n' with '<br>'.
     * 
     * @return string
     */
    public function format_content()
    {
        return nl2br(stripcslashes($this->content), false);
    }

    public function csv_tags()
    {
        $tag_titles = [];
        foreach ($this->tags as $tag)
            array_push($tag_titles, $tag->title);

        return implode(',', $tag_titles);
    }
}
