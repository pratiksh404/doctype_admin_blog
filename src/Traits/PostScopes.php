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

    public function scopeRelatedTagPosts($query, $id, $tags, $limit = 5)
    {
        return $query->withAnyTag($tags)->where('id', '<>', $id)->take($limit);
    }

    public function scopeRelatedCategoryPosts($query, $id, $category_id, $limit = 5)
    {
        return $query->where('category_id', $category_id)->where('id', '<>', $id)->take($limit);
    }

    public function scopeRelatedPosts($query, $id, $category_id, $tags, $limit = 5)
    {
        return $query->withAnyTag($tags)
            ->where('category_id', $category_id)
            ->where('id', '<>', $id)
            ->take($limit);
    }

    public function scopeBlog($query)
    {
        return $query->where('type', 1);
    }

    public function scopeEvent($query)
    {
        return $query->where('type', 2);
    }

    public function scopeNews($query)
    {
        return $query->where('type', 3);
    }

    public function scopeJob($query)
    {
        return $query->where('type', 4);
    }

    /* *************************************************************************************** */
}
