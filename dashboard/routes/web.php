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
        // 
        Route::get('/user', 'DashboardController@indexDash')->middleware('user-auth');
        Route::get('/login', 'User\ShowController@showLogin');
                

        // Post for admin show controller
        Route::get('user/posts', 'Post\ShowController@indexOwn')->middleware('user-auth');
        Route::get('new-post', 'Post\ShowController@indexForm')->middleware('user-auth');
        Route::get('user/all-posts', 'Post\ShowController@indexAll')->middleware('user-auth');
        Route::get('post-detail/{url}/{id}', 'Post\ShowController@indexPost')->middleware('user-auth');
        Route::get('edit-post/{id}', 'Post\ShowController@indexEditForm')->middleware('user-auth');
        Route::get('delete-post/{id}', 'Post\DeletePostController');

        // Permission show controller
        Route::get('delete-permission/{slug}/{id}', 'User\DeletePermissionController')->middleware('user-auth');
        Route::get('delete-role/{slug}/{id}', 'User\DeleteRoleController')->middleware('user-auth');
        Route::get('user/user-list', 'User\ShowController@showList')->middleware('user-auth');
        Route::get('user-permission/{id}', 'User\ShowController@showPermissionPage')->middleware('user-auth');
        Route::get('user-role/{id}', 'User\ShowController@showRolePage')->middleware('user-auth');

        // Cache Config
        Route::get('/user/cache-config', 'CacheController@indexCachePage')->middleware('user-auth');
        Route::get('user/delete-cache/{key}', 'CacheController@deleteCacheKey')->middleware('user-auth');
        Route::post('/user/config-server', 'CacheController@configCacheServer');
    });

// Cache config server

// front view 
Route::get('/', 'DashboardController@indexHome');
Route::get('news', 'DashboardController@indexNewsList');        
Route::get('hot', 'DashboardController@indexHotList');
Route::get('news/{url}/{id}', 'DashboardController@indexNews');
Route::get('hot/{url}/{id}', 'DashboardController@indexNews');

    
// Login, register
Route::get('/register', 'User\ShowController@showRegister');
Route::get('/verify/{token}', 'VerifyController@VerifyEmail')->name('verify');
Route::post('user-store', 'User\RegisterController');
Route::post('user-login', 'User\LoginController');

// Post controller: create, edit
Route::post('post-create', 'Post\CreatePostController@create');
Route::post('edit-post/edit/{id}', 'Post\EditPostController');

// Permission controller
Route::post('add-permission/{id}', 'User\AddPermissionController')->middleware('user-auth');
Route::post('add-role/{id}', 'User\AddRoleController')->middleware('user-auth');

Route::get('/logout', 'User\LogoutController');