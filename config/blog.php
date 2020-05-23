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