
![Doctype Admin Blog](https://github.com/pratiksh404/doctype_admin_blog/blob/master/screenshot/doctype_blog.png)


## Laravel 7 Admin Panel for lazy developers. 

#### Contains : -
  - Post Management
  - Category Management



### Installation

Run Composer Require Command

```sh
composer require doctype_admin/blog
```

Create a copy of your .env file

```sh
cp .env.example .env
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
    'middleware' => ['web','auth','activity'],
    
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

License
----

MIT


**DOCTYPE NEPAL ||DR.H2SO4**



