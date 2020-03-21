<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;

use App\User;
use App\Post;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class EditPostController extends Controller
{
    //
    public function __invoke(Request $request, $id) {
        $post=Post::findorFail($id);
        $user = Auth::user();
        if($post->user_id==$user->id||$user->can('edit')){
            $post->title = $request->title;
            $post->content = $request->content;

            if($request->has('url')) $url = Str::slug($request->url);
                else $url=Str::slug($request->title);
            
            $post->url = $url;
            $post->save();
        } else return redirect::intended('')->with('error', 'You dont have permission to edit this post.');
        if(is_null($post)) return back()->with('error', 'Something went wrong! Please try again later');
        return redirect::intended('')->with('success', 'Post edited successfully');
    }
}
