<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use doctype_admin\Blog\Models\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
      "id" => 1,
      "author_id" => 1,
      "category_id" => 1,
      "title" => "Welcome Doctype Admin Blog",
      "seo_title" => "Doctype Admin Blog",
      "excerpt" => "This is blog plugin for doctype admin panel that make awesome blog post",
      "body" => "<p>
      <b>Doctype Admin</b> is a simple admin panel made for lazy developer like we all are.
      <br>
      This admin panel focuses on a saving time of our fellow developer who spend working on building admin starter structure everytime for each and every project.
      <br>
      <h1>So...</h1> This admin panel provides a admin starter system which includes Role Management, Permission Management, User Management and Activity Logger.
      <br>
      Along with that it also contains tons of plugin that you can install seperatly like blog plugin etc
      <br>
      Support Author : Pratik Shrestha
      Github : pratiksh404
      <br>
      <i>Keeping coding...love laravel</i>
      </p>
      ",
      "image" => "",
      "slug" => "doctype-admin",
      "meta_description" => "This is blog plugin for doctype admin panel that make awesome blog post",
      "meta_keywords" => "doctype admin",
      "status" => "3",
      "featured" => "1"
    ];
});