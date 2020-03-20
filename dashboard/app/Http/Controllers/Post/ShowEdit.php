<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

use App\User;
use App\Post;

class ShowEdit extends Controller{
    public function __invoke($id){
        if(Auth::check()){
            $user=Auth::user(); 
            $post = Post::findorFail($id);
            if($post->user_id==$user->id||$user->can('edit')) return view('post.post-edit')->with('post', $post);
            else return redirect::intended('')->with('error', 'You dont have permission to edit this post.');
        }
        else return redirect::intended('login')->withError('You do not have permission to access');
    }
}
?>