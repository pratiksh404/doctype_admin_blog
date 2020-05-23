<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use doctype_admin\Blog\Models\Category;
use Faker\Generator as Faker;

$factory->define(Category::class,function(Faker $faker){
    return [
        "name" => "Doctype Admin",
        "slug" => "doctype-admin-category"
    ];
});