<?php

namespace doctype_admin\Blog;

use doctype_admin\Blog\Interfaces\PostDataRepositoryInterface;
use doctype_admin\Blog\Interfaces\PostRepositoryInterface;
use doctype_admin\Blog\Repository\PostDataRepository;
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

    public function register()
    {
        $this->app->bind(PostRepositoryInterface::class, PostRepository::class);
        $this->app->bind(PostDataRepositoryInterface::class, PostDataRepository::class);
    }
}
