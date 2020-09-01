<?php

namespace doctype_admin\Blog\Models;

use App\User;
use App\Traits\ModelScopes;
use Conner\Tagging\Taggable;
use doctype_admin\Blog\Models\Category;
use drh2so4\Thumbnail\Traits\Thumbnail;
use Illuminate\Database\Eloquent\Model;
use doctype_admin\Blog\Traits\PostScopes;
use Cviebrock\EloquentSluggable\Sluggable;

class Post extends Model
{
    use Taggable, PostScopes, ModelScopes, Sluggable, Thumbnail;

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

    public function getStatusAttribute($attribute)
    {
        return [
            1 => "Pending",
            2 => "Draft",
            3 => "Published"
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
}
