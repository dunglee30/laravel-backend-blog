<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cache;

use App\User;
use App\Post;
use App\Permission;

class ShowController extends Controller
{
    //
    public function indexOwn() {
            $user=Auth::user();
            $posts=Cache::remember('postUser.'.$user->id, 60*10, function() use ($user){
                return $user->posts()->where('user_id', $user->id)->get();
            });
            $url = url()->current();
            $ownPostHtml = Cache::remember('ownPostHtml', 60*10, function() use ($posts){
                return view('post.post', ['posts'=>$posts])->render();
            });
            return response($ownPostHtml);
            // return view('post.post')->with('posts', $posts);
    }

    public function indexAll() {
            $posts=Cache::remember('post.all', 60*10, function() {
                return Post::all()->sortBy('user_id');
            });
            $url = url()->current();
            $allPostHtml = Cache::remember('allPostHtml', 60*10, function() use ($posts){
                return view('post.post', ['posts'=>$posts])->render();
            });
            return response($allPostHtml);
            // return view('post.post')->with('posts', $posts);
    }

    public function indexForm() {
            $formCreate = view('post.post_form')->render();
            return response($formCreate);
            // return view('post.post_form');
    }

    public function indexPost($url, $id){
            $user = Auth::user(); 
            $post = Cache::remember('postID.'.$id, 60*5, function() use($id){
                return Post::findorFail($id);
            });

            if(($post->user_id==$user->id)
                ||$user->can('view')
                ||$user->can('edit')
                ||$user->can('delete')
                ||$user->can('manage')) {
                    if($post->views==null) $post->views=0;
                    $post->views++;
                    $post->save();
                    
                    $url = url()->current();
                    $postDetailHtml = Cache::remember('postDetailHtml'.$id, 60*10, function() use($post){
                        return view('post.post-detail', ['post'=>$post])->render();
                    });
                    return response($postDetailHtml);
                }
            else return back()->with('error', 'You dont have permission to view this post.');
    }

    public function indexEditForm($id){
            $user=Auth::user(); 
            $post = Cache::remember('postID.'.$id, 60*5, function() use($id){
                return Post::findorFail($id);
            });
            if(($post->user_id==$user->id)
                ||$user->can('edit')
                ||$user->can('manage')) {
                    $url = url()->current();
                    $postEditHtml = Cache::remember('postEditHtml'.$id, 60*10, function() use($post){
                        return view('post.post-edit', ['post'=>$post])->render();
                    });
                    return response($postEditHtml);
                }
            else return redirect::back()->with('error', 'You dont have permission to edit this post.');
    }
}
