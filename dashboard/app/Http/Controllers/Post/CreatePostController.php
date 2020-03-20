<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

use App\User;
use App\Post;


class CreatePostController extends Controller
{
    //

    public function create(Request $request) {
        $user = Auth::user();
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'image' => 'image|mimes:jpeg,jpg,png',
        ]);
        $image = null;
        if($file = $request->file('image')){
            $filename = time().'.'.$file->getClientOriginalExtension();
            // $request->image->move(public_path('images'), $filename);
            $path = $file->storeAs('', $filename, 'images');
            $image = $filename;
            // echo $path;
        }
        // echo $image;
        
        $post = Post::create([
            'title' =>$request->title,
            'content' => $request->content,
            'image' => $image,
            'url'=>Str::slug($request->title),
            'user_id' => $user->id,
        ]);
        if(is_null($post)) return back()->with('error', 'Something went wrong! Please try again later');
        return redirect()->intended('')->with('success', 'Post created successfully');
    }
}
