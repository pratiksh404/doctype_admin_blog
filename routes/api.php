<?php


/*
|--------------------------------------------------------------------------
| Blog API Routes
|--------------------------------------------------------------------------
| 
*/
/* Show Post */
Route::get('post/{slug}', 'FrontendPostApiController@showPost');

/* Retrive Featured Post */
Route::get('featured-post/{limit?}', 'FrontendPostApiController@featuredPosts');

/* Retrive Published Posts */
Route::get('published-post/{limit?}', 'FrontendPostApiController@publishedPosts');

/* Retrive User Published Posts */
Route::get('user-published-post/{user_id}/{limit?}', 'FrontendPostApiController@userPublishedPosts');

/* Retrive Blog Post */
Route::get('blogs', 'FrontendPostApiController@blog');

/* Retrive Event Post */
Route::get('events', 'FrontendPostApiController@event');

/* Retrive News Post */
Route::get('news', 'FrontendPostApiController@news');

/* Retrive Job Post */
Route::get('jobs', 'FrontendPostApiController@job');

/* Retrives Related Tag Posts */
Route::get('related-tag-post/{post_id}/{limit?}', 'FrontendPostApiController@relatedTagPosts');

/* Retrives Related Category Posts */
Route::get('related-category-post/{post_id}/{limit?}', 'FrontendPostApiController@relatedCategoryPosts');

/* Retrives Related  Posts */
Route::get('related-post/{post_id}/{limit?}', 'FrontendPostApiController@relatedPosts');
