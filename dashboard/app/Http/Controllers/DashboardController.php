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
        $url = url()->current();
        $dashHtml = Cache::remember('dashHtml', 60*20, function(){
            return view('dashboard')->render();
        });
        return response($dashHtml);
    }

    public function indexHome() {
        $url = url()->current();
        $homeHtml = Cache::remember('homeHtml', 60*5, function() {
            return view('home')->render();
        });
        // $homeHtml = view('home')->render();
        
        return response($homeHtml);
    }

    public function indexNewsList() {
        $posts=Cache::remember('newsL.all', 60*10, function() {
            return Post::public()->get();
        });
        $url = url()->current();
        $newsListHtml = Cache::remember('newsListHtml', 60*10, function() use($posts) {
            return view('news.news_list', ['posts'=>$posts])->render();
        });
        return response($newsListHtml);
    }

    public function indexHotList() {
        $posts=Cache::remember('newsH.all', 60*10, function() {
            return Post::public()->get();
        });
        $url = url()->current();
        $hotListHtml = Cache::remember('hotListHtml', 60*10, function() use ($posts) {
            return view('news.hot_list', ['posts'=>$posts])->render();
        });
        return response($hotListHtml);
    }

    public function indexNews($url, $id) {
        $post = Cache::remember('newsID.'.$id, 60*5, function() use($id){
            $item = Post::findorFail($id);
            $item->views++;
            $item->save();
            return $item;
        });
        $postList = Post::limit(5)->get()->except($id);

        $url = url()->current();
        $newsDetailHtml = Cache::remember('newsDetailHtml'.$id, 60*10, function() use ($post, $postList) {
            return view('news.news_detail', ['post'=>$post, 'list'=>$postList])->render();
        });
        return response($newsDetailHtml);
    }

}
