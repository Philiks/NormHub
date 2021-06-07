<?php

namespace App\Services;

use App\Models\Blog;
use App\Models\Tag;
use InvalidArgumentException;

class StoryService
{
    const AVERAGE_WORD_PER_MINUTE = 275;

    /**
     * Compute the estimated read time of the blog.
     * Took the average of 200 and 350 (college and adult range).
     * Source: https://scholarwithin.com/average-reading-speed
     * 
     * @param string $content
     * @param Illuminate\Database\Eloquent\Blog $blog
     * 
     * @return void
     * 
     * @throws InvalidArgumentException
     */
    public function compute_read_time(string $content, Blog $blog)
    {
        $read_time = count(preg_split('/\s+/', $content)) / StoryService::AVERAGE_WORD_PER_MINUTE;
        $blog->update(['read_time' => $read_time]);
    }

    /**
     * Strip tags from the request and sync the record to the pivot table blog_tag.
     * 
     * @param string $tag_str
     * @param Illuminate\Database\Eloquent\Blog $blog
     * 
     * @return array
     */
    public function sync_tags(string $tag_str, Blog $blog)
    {
        $tags = explode(',', $tag_str);
        $tags_final = [];
        foreach ($tags as $tag) {
            $filtered_tag = Tag::firstOrCreate(['title' => $tag]);
            array_push($tags_final, $filtered_tag->id);
        }

        $blog->tags()->sync($tags_final);

        return $tags_final;
    }
}