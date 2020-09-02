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

    /* *************************************************************************************** */
}
