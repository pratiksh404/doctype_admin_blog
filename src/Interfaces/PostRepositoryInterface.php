<?php

namespace doctype_admin\Blog\Interfaces;

interface PostRepositoryInterface
{
    public function indexPost();

    public function createPost();

    public function storePost($request);

    public function showPost($post);

    public function editPost($post);

    public function updatePost($request, $post);

    public function destroyPost($post);

    public function postPublished($post);

    public function postUnpublished($post);

    public function postFeatured($post);

    public function postUnfeatured($post);
}
