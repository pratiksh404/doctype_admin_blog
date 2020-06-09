![Doctype Admin Blog](https://github.com/pratiksh404/doctype_admin_blog/blob/master/screenshot/doctype_blog.png)

[![Issues](https://img.shields.io/github/issues/pratiksh404/doctype_admin_blog)](https://github.com/pratiksh404/doctype_admin_blog/issues)
[![Stars](https://img.shields.io/github/stars/pratiksh404/doctype_admin_blog)](https://github.com/pratiksh404/doctype_admin_blog/stargazers)

## Laravel 7 Admin Panel for lazy developers.

#### Contains : -

- Post Management
- Category Management

### Installation

Run Composer Require Command

```sh
composer require doctype_admin/blog
```

### Install package assets

#### Install all assets

```sh
php artisan DoctypeAdminBlog:install -a
```

This command will publish

- config file named Blog.php
- views files of post and category
- migrations files
- seed files

#### Install config file only

```sh
php artisan DoctypeAdminBlog:install -c
```

#### Install view files only

```sh
php artisan DoctypeAdminBlog:install -f
```

#### Install migrations files only

```sh
php artisan DoctypeAdminBlog:install -m
```

#### Install seed files only

```sh
php artisan DoctypeAdminBlog:install -s
```

## Then migrate database

```sh
php artisan migrate
```

If you want to migrate file with seed

```sh
php artisan migrate --seed
```

This Package includes two seed

- PostsTableSeeder
- CategoriesTableSeeder
  To use specific seed use

```sh
php artisan db:seed --class=PostsTableSeeder
php artisan db:seed --class=CategoriesTableSeeder
```

## Package Config File

```sh
<?php

return [


    /*
    |--------------------------------------------------------------------------
    | Doctype Admin Post Tagging Feature
    |--------------------------------------------------------------------------
    |
    | This option define whether to use post tagging feature provided by the
    | package.This package uses https://github.com/rtconner/laravel-tagging
    |
    */
    'post_tagging' => true,

    /*
    |--------------------------------------------------------------------------
    | Doctype Admin Blog default prefix
    |--------------------------------------------------------------------------
    |
    | This option defines the default prefix of all routes of blog plugins to
    | your admin panel. The default prefix is admin. You can change the prefix
    | but we highly recommend to use default one.
    */
    'prefix' => 'admin',

    /*
    |--------------------------------------------------------------------------
    | Doctype Admin Blog Middlewares
    |--------------------------------------------------------------------------
    |
    | This option includes all the middleware used by routes og doctype admin
    | blog package.
    | Note: If you don;t want activity logging of post and category model simply
    | remove activity middleware
    |
    */
    'middleware' => ['web', 'auth', 'activity'],

    /*
    |--------------------------------------------------------------------------
    | Doctype Admin Blog Thmbnail Feature
    |--------------------------------------------------------------------------
    |
    | This option defines whether to use Package's Thumbnail Featured or not
    | Default option is true
    |
    */
    'thumbnail' => true,

    /*
    |--------------------------------------------------------------------------
    | Thumbnail Qualities
    |--------------------------------------------------------------------------
    |
    | These options are default post image and its thumbnail quality
    |
    |
    */

    'image_quality' => 80,
    'medium_thumbnail_quality' => 60,
    'small_thumbnail_quality' => 30,

    /*
    |--------------------------------------------------------------------------
    | Default Image Fit Size
    |--------------------------------------------------------------------------
    |
    | These option is default post imahe height and width fit size
    |
    |
    */

    'img_width' => 1000,
    'img_height' => 800,

    'medium_thumbnail_width' => 800,
    'medium_thumbnail_height' => 600,

    'small_thumbnail_width' => 400,
    'small_thumbnail_height' => 300,

];

```

## To add the package route link to be accesable from sidemenu just add following on config/adminlte.php undr key 'menu'

```sh
        [
            'text' => 'Blog',
            'icon' => 'fas fa-blog',
            'submenu' => [
                           [
                               'text' => 'Posts',
                               'icon' => 'fas fa-file',
                               'url' => 'admin/post',
                           ],
                           [
                             'text' => 'Categories',
                             'icon' => 'fas fa-bezier-curve',
                             'url' => 'admin/category',
                           ]
                          ]
        ],
```

## Post Scopes

| Scopes                                         | Description                                                             |
| ---------------------------------------------- | ----------------------------------------------------------------------- |
| Post::featured()->get()                        | Retives all featured posts                                              |
| Post::featuredLimit(\$limit)->get()            | Retives \$limit(type integer) no. of posts                              |
| Post::published()->get()                       | Retrives published posts                                                |
| Post::draft()->get()                           | Retrives draft posts                                                    |
| Post::pending()->get()                         | Retrives pending posts                                                  |
| Post::scopeRelatedTagPost(\$post)->get()       | Retrive related post of instance \$post having common tags              |
| Post::scopeRelatedCategoryPosts(\$post)->get() | Retrive related post of instance \$post having common category          |
| Post::scopeRelatedPosts(\$post)->get()         | Retrive related post of instance \$post having common tags and category |

## Related Post Usages

```sh
$post = Post::find($id);
scopeRelatedTagPost = Post::relatedPost($post); //retrives all the related posts to $post using some or all tags used by $post

$scopeRelatedTagPostlimited = Post::relatedPost($post,8); //retrives 8 related post, default limit is 5
```

similar goes to relatedTagPost and relatedPost.

## Note

- relatedTagPost scopes uses tags used by the instance to find out other related post using its tags.
- If you want to use ModelScope provied by doctype admin panel just use ModelScopes on Post Model

## Working with package

- This package uses https://github.com/rtconner/laravel-tagging for tagging posts so you can check it's documentation for further manipulation
- This package uses https://github.com/cviebrock/eloquent-sluggable for slugging post so you can check it's documentation for further manipulation

## Our Post Model

```sh
<?php

namespace doctype_admin\Blog\Models;

use App\User;
use Conner\Tagging\Taggable;
use doctype_admin\Blog\Models\Category;
use doctype_admin\Blog\Traits\PostScopes;
use Illuminate\Database\Eloquent\Model;
use App\Traits\ModelScopes;
use Cviebrock\EloquentSluggable\Sluggable;

class Post extends Model
{
    use Taggable, PostScopes, ModelScopes, Sluggable;

    protected $guarded = [];

    public function save(array $options = [])
    {
        // If no author has been assigned, assign the current user's id as the author of the post
        if (!$this->author_id && Auth::user()) {
            $this->author_id = Auth::user()->getKey();
        }

        return parent::save();
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function getStatusAttribute($attribute)
    {
        return [
            1 => "Pending",
            2 => "Draft",
            3 => "Published"
        ][$attribute];
    }

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}

```

### What's New ?

New Thumbnail featured added

How to use thumbnails ?
Just use as follows

```sh
   @foreach ($images as $image)
       <img src="{{asset($image->thumbnail('small'))}}"> // For small thumbnail
   <img src="{{asset($image->thumbnail('medium'))}}"> // For medium thumbnail
   @endforeach
```

### Admin Panel Screenshot

![Doctype Admin Blog](https://github.com/pratiksh404/doctype_admin_blog/blob/master/screenshot/post.jpg)
![Doctype Admin Blog](https://github.com/pratiksh404/doctype_admin_blog/blob/master/screenshot/create_post.jpg)
![Doctype Admin Blog](https://github.com/pratiksh404/doctype_admin_blog/blob/master/screenshot/category.jpg)

### Todos

- Better Confile File Control
- Post Analytics
- Algolia Post Search Funtionality
- Maintainabilty
- Better UI

## Package Used

- https://github.com/rtconner/laravel-tagging
- https://github.com/jeroennoten/Laravel-AdminLTE
- https://github.com/cviebrock/eloquent-sluggable

## License

MIT

**DOCTYPE NEPAL ||DR.H2SO4**
