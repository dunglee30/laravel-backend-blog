<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::middleware(['prevent-back-history'])->group(function(){
        Auth::routes();
        Route::get('/', 'DashboardController@dashboard');
        Route::get('/login', 'User\ShowController@showLogin');

        Route::get('user/posts', 'Post\ShowController@indexOwn');
        Route::get('new-post', 'Post\ShowController@indexForm');
        
        Route::get('user/all-posts', 'Post\ShowController@indexAll');

        Route::get('post-detail/{url}/{id}', 'Post\ShowController@indexPost');
        Route::get('edit-post/{id}', 'Post\ShowEdit');
        Route::get('delete-post/{id}', 'Post\DeletePostController');
        Route::get('delete-permission/{slug}/{id}', 'User\DeletePermissionController');
        
        Route::get('user/user-list', 'User\ShowController@showList');
        Route::get('user-permission/{id}', 'User\ShowController@showPermissionPage');
    });
    
Route::get('/register', 'User\ShowController@showRegister');

Route::post('user-store', 'User\RegisterController');
Route::post('user-login', 'User\LoginController');
Route::post('post-create', 'Post\CreatePostController@create');
Route::post('edit-post/edit/{id}', 'Post\EditPostController');
Route::post('add-permission/{id}', 'User\AddPermissionController');

Route::get('/logout', 'User\LogoutController');