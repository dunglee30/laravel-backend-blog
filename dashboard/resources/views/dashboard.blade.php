@extends('master')

@section('stylesheet')
    @include('style')
@endsection

@section('content')
<div class="container-fluid">
    @include('sidebar')
    
    <main class="col-sm-9 ml-sm-auto col-md-10 pt-3">
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
        <div class="row">
                <div class="col-sm-6 col-md-4 col-md-offset-4 col-sm-offset-3">
                    <div id="message" class="alert alert-danger">
                        {{ Session::get('error') }}
                    </div>
                </div>
            </div>
        @endif
        <h1> Welcome {{ Auth::user()->name }} </h1>
    </main>

</div>
@endsection