<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

use App\User;
use App\Post;
use App\Permission;

class ShowController extends Controller
{
    //
    public function indexOwn() {
        
        if(Auth::check()){
            $user=Auth::user();
            $posts=$user->posts()->where('user_id', $user->id)->get();
            return view('post.post')->with('posts', $posts);
        }
        else return redirect::intended('login')->withError('You do not have permission to access');
    }

    public function indexAll() {
        if(Auth::check()){
            $posts=Post::all()->sortBy('user_id');
            return view('post.post')->with('posts', $posts);
        }
        else return redirect::intended('login')->withError('YO do not have permissions to access');
    }

    public function indexForm() {
        if(Auth::check()){ 
            return view('post.post_form');
        }
        else return redirect::intended('login')->withError('You do not have permission to access');
    }

    public function indexPost($url, $id){
        if(Auth::check()){
            $user = Auth::user();
            $post = Post::findorFail($id);
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
        else return redirect::intended('login')->withError('You do not have permission to access');
    }

    public function indexEditForm($id){
        if(Auth::check()){
            $user=Auth::user(); 
            $post = Post::findorFail($id);
            if($post->user_id==$user->id) return view('post.post-edit')->with('post', $post);
            else return redirect::back()->with('error', 'You dont have permission to edit this post.');
        }
        else return redirect::intended('login')->withError('You do not have permission to access');
    }
}
