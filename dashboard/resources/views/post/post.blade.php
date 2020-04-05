@extends('master')

@section('stylesheet')
    @include('style')
@endsection

@section('content')
<div class="container-fluid">
    @include('sidebar')

    <main role='main' class="col-sm-9 ml-sm-auto col-md-10 pt-3">
        <h1>
            POST 
            <a href="{{ url('new-post') }}">
                <button type="button" class="btn btn-primary btn-sm"> Create Post </button>
            </a>
            
        </h1>

        @if(Session::has('success'))
            <div class="row">
                <div class="col-sm-6 col-md-4 col-md-offset-4 col-sm-offset-3">
                    <div id="message" class="alert alert-success">
                        {{ Session::get('success') }}
                    </div>
                </div>
            </div>
        @endif

        @if(Session::has('error'))
            <div class="alert alert-danger">
                {{ Session::get('error') }}
                    @php
                        Session::forget('error');
                    @endphp
            </div>
        @endif
        <table class="table table-striped table-hover">
            <thread>
                <th>#</th>
                <th>Title</th>
                <th>Author</th>
                <th>Date Created</th>
                <th>View more</th>
                <th>Delete</th>
            </thread>

            <tbody>
                @if($posts)
                    @foreach($posts as $post)
                        <!--  -->
                        <tr>
                            <th>{{ $loop->iteration }} </th>
                            <td>{{ $post->title }} </td>
                            <td>{{ $post->user->name }} </td>
                            <td>{{ Carbon\Carbon::parse($post->created_at)->format('d-m-Y') }} </td>
                            <td>
                                <a href="{{ url('/post-detail',[$post->url, $post->id]) }}"> View more</a>
                            <td>
                                <a onclick="return confirm('Are you sure?')" href="{{ url('delete-post', [$post->id]) }}">
                                    <button type="button" class="btn btn-primary btn-sm"> Delete Post </button>
                                </a>
                        </tr>
                    @endforeach
                @else 
                    <p class="text-center text-primary">No Posts created Yet!</p>
                @endif
            </tbody>
        </table><Br>
        <a onclick="return confirm('Are you sure?')" href="{{ url('postsDeleteAll') }}">
            <button type="button" class="btn btn-primary btn-sm">Delete All Selected</button>
        </a>
    </main>
</div>
@endsection