<?php

namespace doctype_admin\Blog;

use doctype_admin\Blog\Interfaces\PostRepositoryInterface;
use doctype_admin\Blog\Repository\PostRepository;
use Illuminate\Support\ServiceProvider;

class BlogRepositoryServiceProvider extends ServiceProvider
{
    /**
     *
     *Bootstrap Blog Repositories
     *
     *@return void
     *
     */

    public function boot()
    {
        $this->app->bind(PostRepositoryInterface::class, PostRepository::class);
    }
}
