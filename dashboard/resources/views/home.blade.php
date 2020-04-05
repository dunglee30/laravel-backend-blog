@extends('master')

@section('stylesheet')
    @include('style')
@endsection

@section('content')
<div class="container-fluid">
<main class="col-sm-9 ml-sm-auto col-md-10 pt-3">
@guest
    @if(!Auth::user())
        <h1> <b>Dear guest</b> </h1> 
        <h1> Welcome to our Dashboard page </h1>
    
    @endif
    @else
    <h1> <b>Dear {{ Auth::user()->name }} </b> </h1>
    <h1> Welcome to our Dashboard page </h1>
    
    
@endguest
</main>
</div>
@endsection