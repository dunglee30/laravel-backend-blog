<?php

namespace App\Http\Controllers;

use App\User;
use App\Post;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;


class DashboardController extends Controller
{
    // Dashboard controller
    public function indexDash(){
        return view('dashboard');
    }

    public function indexHome() {
        return view('home');
    }

    public function indexNewsList() {
        $posts=Cache::remember('news.all', 60*10, function() {
            return Post::all()->sortBy('views');
        });
        return view('news.news_list')->with('posts', $posts);
    }

    public function indexHotList() {
        $posts=Cache::remember('news.all', 60*10, function() {
            return Post::all()->sortBy('created_at');
        });
        return view('news.news_list')->with('posts', $posts);
    }

    public function indexNews($url, $id) {
        $post = Cache::remember('newsID.'.$id, 60*5, function() use($id){
            $item = Post::findorFail($id);
            $item->views++;
            $item->save();
            return $item;
        });

        $postList = Post::limit(5)->get()->except($id);
        return view('news.news_detail', ['post'=>$post, 'list'=>$postList]);
    }

}
