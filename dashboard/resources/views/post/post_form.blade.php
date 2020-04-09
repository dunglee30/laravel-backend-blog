@extends('master')

@section('stylesheet')
    @include('style')
@endsection

@section('content')
<div class="container-fluid">
    @include('sidebar')

    <main role="main" class="col-sm-9 ml-sm-auto col-md-10 pt-3">
        <h1> Create Post </h1>
        <div class="col-md-4" id="form-area">
            <form id="postCreate" method="post" action="{{ url('post-create') }}" enctype='multipart/form-data'>
            @csrf
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" id="id_title" name="title" placeholder="Enter Title" value="{{ old('title') }}">
                    {!! $errors->first('title', '<small class="text-danger">:message</small>') !!}
                </div>
                <div class="form-group">
                    <label for="url">URL</label>
                    <input type="text" class="form-control" id="id_url" name="url" placeholder="Enter URL(Optional)" value="{{ old('url') }}">
                    {!! $errors->first('title', '<small class="text-danger">:message</small>') !!}
                </div>
                <div class="form-group">
                    <label for="category">Category</label>
                    <input type="text" class="form-control" id="id_category" name="category" placeholder="Enter Category(Optional)" value="{{ old('category') }}">
                    {!! $errors->first('title', '<small class="text-danger">:message</small>') !!}
                </div>
                <div class="form-group">
                    <label for="image">Upload Image</label>
                    <input type="file" name="image" id="image">
                </div>
                <div class="form-group">
                    <label for="content"> Content </label>
                    <textarea class="form-control" id="id_content" rows="5" name="content" placeholder="Enter content"></textarea>
                    {!! $errors->first('content', '<small class="text-danger">:message</small>') !!}
                </div>
            
                <button type="submit" class="btn btn-primary" >Create Post</button>
            </form>
        </div>
    </main>
</div>
@endsection