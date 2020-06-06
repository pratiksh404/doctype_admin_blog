<?php

namespace doctype_admin\Blog\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use doctype_admin\Blog\Models\Post;
use doctype_admin\Blog\Models\Category;
use RealRashid\SweetAlert\Facades\Alert as Alert;
use Intervention\Image\Facades\Image as Image;
use Cviebrock\EloquentSluggable\Services\SlugService;

class PostsController extends Controller
{
    /**
     *
     *Display a listing of resources
     *
     *@return \Illuminate\Http\Response
     *
     */

    public function index()
    {
        $posts = Post::with('category')->get();
        return view('blog::post.index', compact('posts'));
    }

    /**
     *
     *Show tthe form for creating new resources
     *
     *@return \Illuminate\Http\Response
     *
     */
    public function create()
    {
        $categories = Category::all();
        /* Retriving Tags */
        $tags = config('blog.post_tagging', 'true') == true ? Post::existingTags()->pluck('name') : false;
        return view('blog::post.create', compact('categories', 'tags'));
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
        $post = Post::create($this->validateData());
        if (config('blog.post_tagging', 'true')) {
            /* Assigning tags */
            $post->tag(explode(',', $request->tags));
            $this->uploadImage($post);
        }
        Alert::success("Post Created", "Success");
        return redirect(config('blog.prefix', 'admin') . '/' . 'post');
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
        /* Retriving tags */
        $tags = config('blog.post_tagging', 'true') == true ? $post->existingTags()->pluck('name') : false;
        $remove_tags = config('blog.post_tagging', 'true') == true ? $post->tagged->pluck('tag_name') : false;
        $categories = Category::all();
        return view("blog::post.edit", compact('post', 'tags', 'remove_tags', 'categories'));
    }



    public function update(Request $request, Post $post)
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
        return redirect(config('blog.prefix', 'admin') . '/' . 'post');
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
        $post->delete();
        Alert::error("Post Deleted", "Success");
        return redirect(config('blog.prefix', 'admin') . '/' . 'post');
    }


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
        if (!empty(request()->image) && request()->has('image')) {

            /* ------------------------------------------------------------------- */

            $image_file = request()->file('image'); // Retriving Image File
            $filenamewithextension  = $image_file->getClientOriginalName(); //Retriving Full Image Name
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME); //Retriving Image Filename only
            $extension = $image_file->getClientOriginalExtension(); //Retriving Image extension
            $imageStoreName = $filename . "-" . time() . "." . $extension; //Making Image Store name

            /* ------------------------------------------------------------------- */
            $post->update([
                'image' => request()->image->storeAs('uploads/blog/post', $imageStoreName, 'public')
            ]);

            $image = Image::make(request()->file('image')->getRealPath())->fit(config('blog.img_width', 1000), config('blog.img_height', 800));;
            $image->save(public_path('storage/' . $post->image), config('blog.image_quality', 80));

            if (config('blog.thumbnail', true)) {
                /* --------------------- Thumbnail Info--------------------------------- */

                //small thumbnail name
                $smallthumbnail = $filename .  "-" . time() . '-small' . '.' . $extension; // Making Thumbnail Name

                //medium thumbnail name
                $mediumthumbnail = $filename . "-" . time() . '-medium' . '.' . $extension; // Making Thumbnail Name

                $small_thumbnail = request()->file('image')->storeAs('uploads/blog/post', $smallthumbnail, 'public'); // Thumbnail Storage Information
                $medium_thumbnail = request()->file('image')->storeAs('uploads/blog/post', $mediumthumbnail, 'public'); // Thumbnail Storage Information

                /* --------------------------------- Saving Thumbnail------------------------------------ */

                $medium_img = Image::make(request()->file('image')->getRealPath())->fit(config('blog.medium_thumbnail_width', 800), config('blog.medium_thumbnail_height', 600)); //Storing Thumbnail
                $medium_img->save(public_path('storage/' . $medium_thumbnail), config('blog.medium_thumbnail_quality', 60)); //Storing Thumbnail

                $small_img = Image::make(request()->file('image')->getRealPath())->fit(config('blog.small_thumbnail_width', 400), config('blog.small_thumbnail_height', 300)); //Storing Thumbnail
                $small_img->save(public_path('storage/' . $small_thumbnail), config('blog.small_thumbnail_quality', 30)); //Storing Thumbnail

                /* ------------------------------------------------------------------------------------- */
            }
        }
    }

    public function check_slug(Request $request)
    {
        $slug = SlugService::createSlug(Post::class, 'slug', $request->title);
        return response()->json(['slug' => $slug]);
    }
}
