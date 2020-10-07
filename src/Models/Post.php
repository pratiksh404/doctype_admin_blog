<?php

namespace doctype_admin\Blog\Models;

use App\User;
use App\Traits\ModelScopes;
use Conner\Tagging\Taggable;
use Illuminate\Support\Facades\Cache;
use doctype_admin\Blog\Models\Category;
use drh2so4\Thumbnail\Traits\Thumbnail;
use Illuminate\Database\Eloquent\Model;
use doctype_admin\Blog\Traits\PostScopes;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;

class Post extends Model
{
    use Taggable, PostScopes, ModelScopes, Sluggable, SluggableScopeHelpers, Thumbnail;

    protected $guarded = [];

    public function save(array $options = [])
    {
        // If no author has been assigned, assign the current user's id as the author of the post
        if (!$this->author_id && Auth::user()) {
            $this->author_id = Auth::user()->getKey();
        }

        return parent::save();
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    // Status Attribute Accessors
    public function getStatusAttribute($attribute)
    {
        return [
            1 => "Pending",
            2 => "Draft",
            3 => "Published"
        ][$attribute];
    }

    // Type Attribute Accessors
    public function getTypeAttribute($attribute)
    {
        return [
            1 => 'Blog',
            2 => 'Event',
            3 => 'News',
            4 => 'Job Post'
        ][$attribute];
    }

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }


    // Forget cache on updating or saving and deleting
    public static function boot()
    {
        parent::boot();

        static::saving(function () {
            self::cacheKey();
        });

        static::deleting(function () {
            self::cacheKey();
        });
    }

    // Cache Keys
    private static function cacheKey()
    {
        Cache::has('posts') ? Cache::forget('posts') : '';
        Cache::has('pending_posts') ? Cache::forget('pending_posts') : '';
        Cache::has('draft_posts') ? Cache::forget('draft_posts') : '';
        Cache::has('published_posts') ? Cache::forget('published_posts') : '';
        Cache::has('related_tag_posts') ? Cache::forget('related_tag_posts') : '';
        Cache::has('related_category_posts') ? Cache::forget('related_category_posts') : '';
        Cache::has('related_posts') ? Cache::forget('related_posts') : '';
        Cache::has('blog_posts') ? Cache::forget('blog_posts') : '';
        Cache::has('event_posts') ? Cache::forget('event_posts') : '';
        Cache::has('news_posts') ? Cache::forget('news_posts') : '';
        Cache::has('job_posts') ? Cache::forget('job_posts') : '';
    }
}
