@extends('master')

@section('stylesheet')
    @include('style')
@endsection

@section('content')

<div class="container-fluid" id="news-area">
    <main role="main" class="col-sm-9 ml-sm-auto col-md-10 pt-3">
        <div class="info-area">
            <h1 class="title-area"> {{ $post->title}} </h1>
            <h7 class="author-name-area"> Author: {{ $post->user->name }} </h7>
            <h7 class="author-name-area"> Views: {{ $post->views }} </h7>
        </div>
        
        <div class="col-xl-auto blog-main post-main">
        @if($post->image!=null)
            <div>
                <img source="{{ asset('images/'.$post->image) }}" height="400", weight="400"></img>
            </div>
        @endif
            <p> {!! $post->content !!} </p>
        </div>
    </main>

    <div class="col-sm-9 ml-sm-auto col-md-10 pt-3 related-news-area">
        <h5> Related news </h5>
        @if($list)
            @foreach($list as $item)
                <a href="{{ url('/news',[$item->url, $item->id]) }}"> {{ $item->title }}</a>
                <br>
            @endforeach
        @endif
    </div>
</div>
@endsection