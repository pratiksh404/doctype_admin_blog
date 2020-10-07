<?php

namespace doctype_admin\Blog\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Cache;
use doctype_admin\Blog\Models\Category;
use Cviebrock\EloquentSluggable\Services\SlugService;

class CategoriesController extends Controller
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
        $categories = config('blog.caching', true)
            ? Cache::has('categories') ? Cache::get('categories') : Cache::rememberForever('categories', function () {
                return Category::all();
            })
            : Category::all();
        return view("blog::category.index", compact('categories'));
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
        return view("blog::category.create");
    }

    /**
     *
     *Stores a newly created resourcesin storage
     *
     *@param \Illuminate\Http\Request $request
     *
     *@return \Illuminate\Http\Response
     *
     */
    public function store(Request $request)
    {
        Category::create($this->validateData());
        toast("Post Category Created", "success");
        return redirect(config('blog.prefix', 'admin') . '/' . 'category');
    }

    /**
     *
     *Shows the form to edit specified resources
     *
     *@param doctype_admin\Blog\Http\Models\Category $category
     *
     *@return \Illuminate\Http\Response
     *
     */
    public function edit(Category $category)
    {
        return view("blog::category.edit", compact('category'));
    }

    /**
     *
     *Updates the speciefed resource
     *
     *@param \Illuminate\Http\Request
     *@param \doctype_admin\Blog\Http\Models\Category $category
     *
     *@return \Illuminate\Http\Response
     *
     */
    public function update(Request $request, Category $category)
    {
        $category->update($this->validateData());
        toast("Post Category Updated", "info");
        return redirect(config('blog.prefix', 'admin') . '/' . 'category');
    }

    /**
     *
     *Destroys the speciefed resource
     *
     *@param \doctype_admin\Blog\Http\Models\Category $category
     *
     *@return \Illuminate\Http\Response
     *
     */
    public function destroy(Category $category)
    {
        $category->delete();
        toast("Post Category Deleted", "error");
        return redirect(config('blog.prefix', 'admin') . '/' . 'category');
    }


    private function validateData()
    {

        return request()->validate([
            'name' => 'required|max:50',
            'slug' => 'required|max:50'
        ]);
    }

    public function check_slug(Request $request)
    {
        $slug = SlugService::createSlug(Category::class, 'slug', $request->name);
        return response()->json(['slug' => $slug]);
    }
}
