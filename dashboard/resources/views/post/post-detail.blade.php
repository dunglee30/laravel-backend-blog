@extends('master')

@section('stylesheet')
    @include('style')
@endsection

@section('content')

<div class="container-fluid">
@include('sidebar')
    <main role="main" class="col-sm-9 ml-sm-auto col-md-10 pt-3">
        <div >
            <h1 class="title-area"> {{ $post->title}} </h1>
            <h5 class="author-name-area"> Author: {{ $post->user->name }} </h5>
            <h5 class="author-name-area"> Views: {{ $post->views }} </h5>
            <h1 id = "ED-area">
                <style> {
                    
                } 
                </style>
                <a href="{{ url('edit-post', $post->id) }}">
                    <button type="button" class="btn btn-primary btn-sm"> Edit Post </button>
                </a><br>
                <a href="{{ url('delete-post', [$post->id]) }}">
                    <button type="button" class="btn btn-primary btn-sm"> Delete Post </button>
                </a>
            </h1>
        </div>
        
        <div class="col-xl-auto blog-main">
        @if($post->image!=null)
            <div>
                <img source="{{ asset('public/images/'.$post->image) }}" height="400", weight="400"></img>
            </div>
        @endif
            <p> {!! $post->content !!} </p>
        </div>
    </main>
</div>
@endsection