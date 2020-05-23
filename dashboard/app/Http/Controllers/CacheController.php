<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use Artisan;

class CacheController extends Controller
{
    //
    public function indexCachePage(){
        $cacheServer = env('CACHE_DRIVER');
        $url = url()->current();
        $redis = Redis::connection('cache');
        $urlList = $redis->keys("*Html*");
        $cacheHtml = view('cache-page', ['urlList'=>$urlList, 'server'=>$cacheServer])->render();
        return response($cacheHtml);
    }

    public function deleteCacheKey($key){
        $redis = Redis::connection('cache');
        $newKey = substr($key, 19, strlen($key)-1);
        if($redis->exists($newKey)){
            $redis->del($newKey);
            return redirect::intended('/user/cache-config')->with('success', 'URL cache deleted successfully');
        }
        return redirect::intended('/user/cache-config')->with('error', 'Something went wrong');
        
    }

    public function setEnvironmentValue($envKey, $envValue)
{
        $envFile = app()->environmentFilePath();
        $str = file_get_contents($envFile);

        $oldValue = env("{$envKey}");

        $str = str_replace("{$envKey}={$oldValue}", "{$envKey}={$envValue}", $str);

        $fp = fopen($envFile, 'w');
        fwrite($fp, $str);
        fclose($fp);
    }

    public function configCacheServer(Request $request) {
        // echo $request->has('group_server');
        // echo $request->group_server;
        if($request->group_server == "redis"){
            $this->setEnvironmentValue('CACHE_DRIVER', 'redis');
            Artisan::call('config:clear');
            return redirect::intended('/user/cache-config')->with('success', 'Cache server config successfully');
            // return;
        }
        else if($request->group_server == "file"){
            $this->setEnvironmentValue('CACHE_DRIVER', 'file');
            Artisan::call('config:clear');
            return redirect::intended('/user/cache-config')->with('success', 'Cache server config successfully');
            // return;
        }
        return redirect::intended('/user/cache-config')->with('error', 'Something went wrong');
    }

}
