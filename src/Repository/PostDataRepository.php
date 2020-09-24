<?php

namespace doctype_admin\Blog\Repository;

use doctype_admin\Blog\Models\Post;
use Illuminate\Support\Facades\Cache;
use doctype_admin\Blog\Interfaces\PostDataRepositoryInterface;

class PostDataRepository implements PostDataRepositoryInterface
{
    // Retrive all posts
    public function allPosts()
    {
        return config('blog.caching', true)
            ? Cache::has('posts') ? Cache::get('posts') : Cache::rememberForever('posts', function () {
                return Post::all();
            })
            : Post::all();
    }

    // Retrive Pending Post
    public function pendingPosts()
    {
        return config('blog.caching', true)
            ? Cache::has('pending_posts') ? Cache::get('pending_posts') : Cache::rememberForever('pending_posts', function () {
                return Post::pending()->get();
            })
            : Post::pending()->get();
    }

    // Retrive Draft Posts
    public function draftPosts()
    {
        return config('blog.caching', true)
            ? Cache::has('draft_posts') ? Cache::get('draft_posts') : Cache::rememberForever('draft_posts', function () {
                return Post::draft()->get();
            })
            : Post::draft()->get();
    }

    // Retrive Published Posts
    public function publishedPosts()
    {
        return config('blog.caching', true)
            ? Cache::has('published_posts') ? Cache::get('published_posts') : Cache::rememberForever('published_posts', function () {
                return Post::published()->get();
            })
            : Post::published()->get();
    }

    // Show Post
    public function showPost($slug)
    {
        $post = Post::whereSlug($slug);
        return $post->where('status', 3) ? $post->get() : null;
    }

    // Posts related according to its tags to instance of post passed
    public function relatedTagPosts($post, $limit = 5)
    {
        $tags = $post->tagged->pluck('tag_slug')->toArray();
        return config('blog.caching', true)
            ?  Cache::has('related_tag_posts') ? Cache::get('related_tag_posts') : Cache::rememberForever('related_tag_posts', function () use ($tags, $post, $limit) {
                return Post::relatedTagPosts($post->id, $tags, $limit)->get();
            })
            : Post::relatedTagPosts($post->id, $tags, $limit)->get();
    }

    // Posts related according to its category to instance of post passed
    public function relatedCategoryPosts($post, $limit = 5)
    {
        return config('blog.caching', true)
            ? Cache::has('related_category_posts') ? Cache::get('related_category_posts') : Cache::rememberForever('related_category_posts', function () use ($post, $limit) {
                return Post::relatedCategoryPosts($post->id, $post->category_id, $limit)->get();
            })
            : Post::relatedCategoryPosts($post->id, $post->category_id, $limit)->get();
    }

    //Posts related according to its tags and category to instance of post passed
    public function relatedPosts($post, $limit = 5)
    {
        $tags = $post->tagged->pluck('tag_slug')->toArray();
        return config('blog.caching', true)
            ?  Cache::has('related_posts') ? Cache::get('related_posts') : Cache::rememberForever('related_posts', function () use ($tags, $post, $limit) {
                return Post::relatedPosts($post->id, $post->category_id, $tags, $limit)->get();
            })
            : Post::relatedPosts($post->id, $post->category_id, $tags, $limit)->get();
    }
}
