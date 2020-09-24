<?php

namespace doctype_admin\Blog\Interfaces;

interface PostDataRepositoryInterface
{
    public function allPosts();

    public function pendingPosts();

    public function draftPosts();

    public function publishedPosts();

    public function showPost($slug);

    public function relatedTagPosts($post, $limit = 5);

    public function relatedCategoryPosts($post, $limit = 5);

    public function relatedPosts($post, $limit = 5);
}
