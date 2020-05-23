<?php

use doctype_admin\Blog\Models\Category;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
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
        factory(Category::class)->create();
    }
}