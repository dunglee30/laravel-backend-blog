<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

use App\User;
use App\Post;

use Storage;

class DeletePostController extends Controller
{
    //
    public function __invoke($id){
        $post=Post::findorFail($id);
        $user = Auth::user();
        if($post->user_id==$user->id||$user->can('delete')){
            Storage::disk('images')->delete($post->image);
            $post->delete();
            return redirect::intended('')->with('success', 'Post deleted successfully');
        } else return redirect::intended('')->with('error', 'You dont have permission to delete this post.');
    }
}
