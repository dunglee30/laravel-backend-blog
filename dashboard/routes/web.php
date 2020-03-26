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
        Route::get('/', 'DashboardController')->middleware('user-auth');
        Route::get('/login', 'User\ShowController@showLogin');

        Route::get('user/posts', 'Post\ShowController@indexOwn')->middleware('user-auth');
        Route::get('new-post', 'Post\ShowController@indexForm')->middleware('user-auth');
        
        Route::get('user/all-posts', 'Post\ShowController@indexAll')->middleware('user-auth');

        Route::get('post-detail/{url}/{id}', 'Post\ShowController@indexPost')->middleware('user-auth');
        Route::get('edit-post/{id}', 'Post\ShowEdit')->middleware('user-auth');
        Route::get('delete-post/{id}', 'Post\DeletePostController');
        Route::get('delete-permission/{slug}/{id}', 'User\DeletePermissionController')->middleware('user-auth');
        
        Route::get('user/user-list', 'User\ShowController@showList')->middleware('user-auth');
        Route::get('user-permission/{id}', 'User\ShowController@showPermissionPage')->middleware('user-auth');
    });
    
Route::get('/register', 'User\ShowController@showRegister');
Route::get('/verify/{token}', 'VerifyController@VerifyEmail')->name('verify');

Route::post('user-store', 'User\RegisterController');
Route::post('user-login', 'User\LoginController');
Route::post('post-create', 'Post\CreatePostController@create');
Route::post('edit-post/edit/{id}', 'Post\EditPostController');
Route::post('add-permission/{id}', 'User\AddPermissionController')->middleware('user-auth');

Route::get('/logout', 'User\LogoutController');