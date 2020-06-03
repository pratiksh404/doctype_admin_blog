<?php

namespace doctype_admin\Blog\Traits;

trait PostScopes
{


    /*************************************** Post Scopes **************************************/
    public function scopeFeatured($query)
    {
        return $query->where('featured', 1);
    }

    public function scopeFeaturedLimit($query, int $limit = 5)
    {
        return $query->where('featured', 1)->take($limit);
    }

    public function scopePublished($query)
    {
        return $query->where('status', 1);
    }

    public function scopeDraft($query)
    {
        return $query->where('status', 2);
    }

    public function scopePending($query)
    {
        return $query->where('status', 3);
    }

    public function scopeVideoPost($query)
    {
        return  $query->whereNotNull('video');
    }

    public function scopeRelatedTagPosts($query, $post, $limit = 5)
    {
        $tags = $post->tagged->pluck('tag_slug')->toArray();
        return $query->withAnyTag($tags)->where('id', '<>', $post->id)->take($limit);
    }

    public function scopeRelatedCategoryPosts($query, $post, $limit = 5)
    {
        return $query->where('category_id', $post->category_id)->take($limit);
    }

    public function scopeRelatedPosts($query, $post, $limit = 5)
    {
        $tags = $post->tagged->pluck('tag_slug')->toArray();
        return $query->$query->withAnyTag($tags)
            ->where('category_id', $post->category_id)
            ->where('id', '<>', $post->id)
            ->take($limit);
    }


    /* *************************************************************************************** */
}
