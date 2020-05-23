<?php

use doctype_admin\Blog\Models\Post;
use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
    *
    *Run the database post seeds
    *
    *@return void
    *
    */

    public function run()
    {
        factory(Post::class)->create();
    }
}
