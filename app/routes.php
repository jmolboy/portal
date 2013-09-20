<?php

Route::get('/', 'Controllers\HomeController@getIndex');

// authentication
Route::get('login', 'Controllers\AuthController@getLogin');
Route::get('signup', 'Controllers\AuthController@getSignup');
Route::get('signup-confirm', 'Controllers\AuthController@getSignupConfirm');
Route::post('signup-confirm', 'Controllers\AuthController@postSignupConfirm');
Route::get('logout', 'Controllers\AuthController@getLogout');
Route::get('oauth', 'Controllers\AuthController@getOauth');

// chat
Route::get('chat', 'Controllers\ChatController@getIndex');

// forum
Route::get('forum', 'Controllers\ForumController@getIndex');
Route::get('forum/{forumCategory}', 'Controllers\ForumController@getCategory');
Route::get('forum/{forumCategory}/create-thread', 'Controllers\ForumController@getCreateThread');
Route::post('forum/{forumCategory}/create-thread', 'Controllers\ForumController@postCreateThread');
Route::get('forum/{forumCategory}/{slug}', ['before' => 'handle_slug', 'uses' => 'Controllers\ForumController@getThread']);
Route::post('forum/{forumCategory}/{slug}', ['before' => 'handle_slug', 'uses' => 'Controllers\ForumController@postThread']);


// admin
Route::group(['before' => 'auth', 'prefix' => 'admin'], function() {

    Route::group(['before' => 'has_role:admin_posts'], function() {
        Route::controller('posts', 'Controllers\Admin\PostsController');
    });

    Route::group(['before' => 'has_role:admin_users'], function() {
        Route::controller('users', 'Controllers\Admin\UsersController');
    });
});