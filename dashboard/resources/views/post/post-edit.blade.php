@extends('master')

@section('stylesheet')
    @include('style')
@endsection

@section('content')
<div class="container-fluid">
@include('sidebar')

<main role="main" class="col-sm-9 ml-sm-auto col-md-10 pt-3">
        <h1> Edit Post </h1>
        <div id="form-area" class="col-md-4">
            <form method="post" action="{{ url('edit-post/edit/'.$post->id) }}">
            @csrf
                <div class="form-group">
                    <label for="name">Title</label>
                    <input type="text" class="form-control" id="id_title" name="title" value="{{ $post->title }}">
                </div>

                <div class="form-group">
                    <label for="content"> Content </label>
                    <textarea class="form-control" id="id_content" rows="5" name="content" placeholder="Enter content">{{$post->content}}</textarea>
                </div>
            
                <button type="submit" class="btn btn-primary">Update post</button>
            </form>
        </div>
    </main>
</div>
@endsection