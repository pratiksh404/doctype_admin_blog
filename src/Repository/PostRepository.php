<?php

namespace doctype_admin\Blog\Repository;


use doctype_admin\Blog\Models\Post;
use doctype_admin\Blog\Models\Category;
use RealRashid\SweetAlert\Facades\Alert as Alert;
use doctype_admin\Blog\Interfaces\PostRepositoryInterface;

class PostRepository implements PostRepositoryInterface
{
    /**
     *
     *Display list of resource
     */
    public function indexPost()
    {
        $posts = Post::with('category')->get();
        return compact('posts');
    }

    /**
     *
     *Create view for resource
     *
     */
    public function createPost()
    {
        $categories = Category::all();
        /* Retriving Tags */
        $tags = config('blog.post_tagging', 'true') == true ? Post::existingTags()->pluck('name') : false;
        return compact('categories', 'tags');
    }

    /**
     *
     *Stores a newly created resource
     *
     */
    public function storePost($request)
    {
        $post = Post::create($this->validateData());
        if (config('blog.post_tagging', 'true')) {
            /* Assigning tags */
            $post->tag(explode(',', $request->tags));
        }
        $this->uploadImage($post);
        Alert::success("Post Created", "Success");
    }

    /**
     *
     *Showes a resource
     *
     */
    public function showPost($post)
    {
        //
    }

    /**
     *
     *Edit Resource
     *
     */
    public function editPost($post)
    {
        /* Retriving tags */
        $tags = config('blog.post_tagging', 'true') == true ? $post->existingTags()->pluck('name') : false;
        $remove_tags = config('blog.post_tagging', 'true') == true ? $post->tagged->pluck('tag_name') : false;
        $categories = Category::all();
        return  compact('post', 'tags', 'remove_tags', 'categories');
    }

    /**
     *
     *Update Resource
     *
     */
    public function updatePost($request, $post)
    {
        $post->update($this->validateData($post->id));
        if (config('blog.post_tagging', 'true')) {
            /* Assigning tags */
            $post->tag(explode(',', $request->tags));
            /* ---------------- */
            /* Removing tags */
            if (!empty($request->remove_tags)) {
                $post->untag($request->remove_tags);
            }
            /* ------------------ */
        }
        $this->uploadImage($post);
        Alert::info('Post Updated', 'Success');
    }

    /**
     *
     *Destroy Resource
     *
     */
    public function destroyPost($post)
    {
        $post->delete();
        Alert::error("Post Deleted", "Success");
    }

    /* Validation */

    private function validateData($id = null)
    {
        return tap(
            request()->validate([
                'author_id' => 'required|numeric',
                'category_id' => 'numeric',
                'title' => 'required|max:100',
                'seo_title' => 'max:100',
                'excerpt' => 'required|max:300',
                'body' => 'sometimes|max:5000',
                'image' => 'sometimes|file|image|max:5000',
                'slug' => 'required|max:100|unique:posts,slug,' . $id ?? '',
                'meta_description' => 'max:200',
                "meta_keywords" => 'max:300',
                "status" => 'required|numeric',
                'featured' => 'required|numeric'
            ]),
            function () {
                if (request()->has('image')) {
                    request()->validate([
                        'image' => 'file|image|max:5000',
                    ]);
                }
            }
        );
    }

    private function uploadImage($post)
    {
        if (request()->image) {
            $thumbnails = [
                'storage' => config('blog.post_image_storage', 'blogs/post')  . '/' . $post->slug,
                'width' => config('blog.img_width', 1000),
                'height' => config('blog.img_height', 800),
                'quality' => config('blog.image_quality', 80),
                'thumbnails' => [
                    [
                        'thumbnail-name' => 'medium',
                        'thumbnail-width' => config('blog.medium_thumbnail_width', 800),
                        'thumbnail-height' => config('blog.medium_thumbnail_height', 600),
                        'thumbnail-quality' => config('blog.medium_thumbnail_quality', 60),
                    ],
                    [
                        'thumbnail-name' => 'small',
                        'thumbnail-width' => config('blog.small_thumbnail_width', 400),
                        'thumbnail-height' => config('blog.small_thumbnail_height', 300),
                        'thumbnail-quality' => config('blog.small_thumbnail_quality', 30),
                    ]
                ]
            ];
            if (config('blog.custom_thumbnails')) {
                return $post->makeThumbnail('image', config('blog.custom_thumbnails'));
            } else {
                return $post->makeThumbnail('image', $thumbnails);
            }
        }
    }
}
