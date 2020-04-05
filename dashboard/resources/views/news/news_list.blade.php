@extends('master')

@section('stylesheet')
    @include('style')
@endsection

@section('content')
<div class="container-fluid news" >
<main role='main' class="col-sm-9 ml-sm-auto col-md-10 pt-3">
        <h1>
            NEWS
        </h1>

        <hr>

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
        <div class="col-md-8">
            <div class="row">
                <div class="news">
                @if($posts)
                    @foreach($posts as $post)
                        <h5> <b>{{ $post->title }} </b> </h5>
                        <h7> Au: {{ $post->user->name }} </h7> 
                        <p>
                            {{ substr(strip_tags($post->content), 0, 60) }}
                            {{ strlen($post->content)>60 ? "..." : ""}}
                        </p>       
                        <a href="{{ url('/news',[$post->url, $post->id]) }}"> View more</a>

                        <hr>
                    @endforeach
                @else 
                    <p class="text-center text-primary">No Posts created Yet!</p>
                @endif
                </div>
            </div>
        </div>
    </main>
</div>
@endsection