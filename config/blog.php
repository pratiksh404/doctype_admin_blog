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
    'middleware' => ['web', 'auth', 'activity', 'role:admin'],

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
