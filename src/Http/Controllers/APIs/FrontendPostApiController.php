<?php

namespace doctype_admin\Blog\Http\Controllers\APIs;

use doctype_admin\Blog\Interfaces\PostDataRepositoryInterface;
use Illuminate\Routing\Controller;
use doctype_admin\Blog\Models\Post;

class FrontendPostApiController extends Controller
{
    // Post Data Repository Initialization
    protected $postDataRepository;

    public function __construct(PostDataRepositoryInterface $postDataRepository)
    {
        $this->postDataRepository = $postDataRepository;
    }

    public function allPosts()
    {
        return $this->postDataRepository->allPosts();
    }

    public function showPost($slug)
    {
        return $this->postDataRepository->showPost($slug);
    }

    public function featuredPosts($limit = null)
    {
        return $limit ? Post::featuredLimit($limit)->get() : Post::featured()->get();
    }

    public function publishedPosts($limit = null)
    {
        $post = Post::published();
        return $limit ? $this->limit($post, $limit) : $post->get();
    }

    public function userPublishedPosts($user_id, $limit = null)
    {
        $post = Post::published()->where('author_id', $user_id);
        return $limit ? $this->limit($post, $limit) : $post->get();
    }

    public function relatedTagPosts($id, $limit = 5)
    {
        $post = Post::findOrFail($id);
        return $this->postDataRepository->relatedTagPosts($post, $limit);
    }

    public function relatedCategoryPosts($id, $limit = 5)
    {
        $post = Post::findOrFail($id);
        return $this->postDataRepository->relatedCategoryPosts($post, $limit);
    }

    public function relatedPosts($id, $limit = 5)
    {
        $post = Post::findOrFail($id);
        return $this->postDataRepository->relatedPosts($post, $limit);
    }

    private function limit($post, $limit)
    {
        return $post->take($limit)->get();
    }
}
