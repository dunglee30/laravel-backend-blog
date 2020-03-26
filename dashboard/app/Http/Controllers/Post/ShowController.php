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
            $posts=Cache::remember('post.'.$user->id, 60*10, function() use ($user){
                return $user->posts()->where('user_id', $user->id)->get();
            });
            return view('post.post')->with('posts', $posts);
    }

    public function indexAll() {
            $posts=Cache::remember('post.all', 60*10, function() {
                return Post::all()->sortBy('user_id');
            });
            return view('post.post')->with('posts', $posts);
    }

    public function indexForm() {
            return view('post.post_form');
    }

    public function indexPost($url, $id){
            $user = Auth::user();
            $post = Cache::remember('post.'.$id, 60*5, function() use($user, $id){
                return Post::findorFail($id);
            });
            // echo $post->title;
            if(($post->user_id==$user->id)
                ||$user->can('view')
                ||$user->can('edit')
                ||$user->can('delete')
                ||$user->can('manage')) {
                    if($post->views==null) $post->views=0;
                    $post->views++;
                    $post->save();
                    
                    return view('post.post-detail')->with('post', $post);
                }
            else return back()->with('error', 'You dont have permission to view this post.');
    }

    public function indexEditForm($id){
            $user=Auth::user(); 
            $post = Post::findorFail($id);
            if($post->user_id==$user->id) return view('post.post-edit')->with('post', $post);
            else return redirect::back()->with('error', 'You dont have permission to edit this post.');
    }
}
