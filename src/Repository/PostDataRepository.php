<?php

namespace doctype_admin\Blog\Repository;

use doctype_admin\Blog\Models\Post;
use doctype_admin\Blog\Interfaces\PostDataRepositoryInterface;

class PostDataRepository implements PostDataRepositoryInterface
{
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
        return Post::withAnyTag($tags)->where('id', '<>', $post->id)->take($limit)->get();
    }

    // Posts related according to its category to instance of post passed
    public function relatedCategoryPosts($post, $limit = 5)
    {
        return Post::where('category_id', $post->category_id)->where('id', '<>', $post->id)->take($limit)->get();
    }

    //Posts related according to its tags and category to instance of post passed
    public function relatedPosts($post, $limit = 5)
    {
        $tags = $post->tagged->pluck('tag_slug')->toArray();
        return Post::withAnyTag($tags)
            ->where('category_id', $post->category_id)
            ->where('id', '<>', $post->id)
            ->take($limit)->get();
    }
}
