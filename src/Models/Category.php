<?php
namespace doctype_admin\Blog\Models;

use doctype_admin\Blog\Models\Post;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $guarded = [];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}