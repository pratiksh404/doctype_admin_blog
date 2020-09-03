<?php

namespace doctype_admin\Blog\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use doctype_admin\Blog\Models\Post;
use Cviebrock\EloquentSluggable\Services\SlugService;
use doctype_admin\Blog\Interfaces\PostRepositoryInterface;

class PostsController extends Controller
{

    /* Post Repository Initialization */

    protected $postRepository;

    public function __construct(PostRepositoryInterface $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    /* ------------------------------ */
    /**
     *
     *Display a listing of resources
     *
     *@return \Illuminate\Http\Response
     *
     */

    public function index()
    {
        return view('blog::post.index', $this->postRepository->indexPost());
    }

    /**
     *
     *Show the form for creating new resources
     *
     *@return \Illuminate\Http\Response
     *
     */
    public function create()
    {
        return view('blog::post.create', $this->postRepository->createPost());
    }

    /**
     *
     *Stores a newly created resources in storage
     *
     *@param \Illuminate\Http\Request $request
     *
     *@return \Illuminate\Http\Response
     *
     */
    public function store(Request $request)
    {
        $this->postRepository->storePost($request);
        return redirect(config('blog.prefix', 'admin/blog') . '/' . 'post');
    }

    /**
     *
     *Show specified resource
     *
     *@param doctype_admin\Blog\Http\Models\Post $post
     *
     *@return \Illuminate\Http\Response
     *
     */

    public function show(Post $post)
    {
        return view("blog::post.show", compact('post'));
    }

    /**
     *
     *Shows the form to edit specified resources
     *
     *@param doctype_admin\Blog\Http\Models\Post $post
     *
     *@return \Illuminate\Http\Response
     *
     */
    public function edit(Post $post)
    {
        return view("blog::post.edit", $this->postRepository->editPost($post));
    }



    public function update(Request $request, Post $post)
    {
        $this->postRepository->updatePost($request, $post);
        return redirect(config('blog.prefix', 'admin/blog') . '/' . 'post');
    }

    /**
     *
     *Destroys the speciefed resource
     *
     *@param \doctype_admin\Blog\Http\Models\Post $post
     *
     *@return \Illuminate\Http\Response
     *
     */
    public function destroy(Post $post)
    {
        $this->postRepository->destroyPost($post);
        return redirect(config('blog.prefix', 'admin/blog') . '/' . 'post');
    }

    /**
     *
     *Updated Posts Status to Published
     *
     *@param \doctype_admin\Blog\Http\Models\Post $post
     *
     *@return \Illuminate\Http\Response
     *
     */
    public function postPublish(Post $post)
    {
        $this->postRepository->postPublished($post);
        return redirect(config('blog.prefix', 'admin/blog') . '/' . 'post');
    }

    /**
     *
     *Updated Posts Status to Published
     *
     *@param \doctype_admin\Blog\Http\Models\Post $post
     *
     *@return \Illuminate\Http\Response
     *
     */
    public function postUnpublish(Post $post)
    {
        $this->postRepository->postUnpublished($post);
        return redirect(config('blog.prefix', 'admin/blog') . '/' . 'post');
    }

    /**
     *
     *Updated Posts Featured to true
     *
     *@param \doctype_admin\Blog\Http\Models\Post $post
     *
     *@return \Illuminate\Http\Response
     *
     */
    public function postFeature(Post $post)
    {
        $this->postRepository->postFeatured($post);
        return redirect(config('blog.prefix', 'admin/blog') . '/' . 'post');
    }

    /**
     *
     *Updated Posts Featured to false
     *
     *@param \doctype_admin\Blog\Http\Models\Post $post
     *
     *@return \Illuminate\Http\Response
     *
     */
    public function postUnfeature(Post $post)
    {
        $this->postRepository->postUnfeatured($post);
        return redirect(config('blog.prefix', 'admin/blog') . '/' . 'post');
    }


    public function check_slug(Request $request)
    {
        $slug = SlugService::createSlug(Post::class, 'slug', $request->title);
        return response()->json(['slug' => $slug]);
    }
}
