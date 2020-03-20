@extends('master')

@section('content')
<div class="container-fluid">
@include('sidebar')

<main role="main" class="col-sm-9 ml-sm-auto col-md-10 pt-3">
    <h1>
        Users
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
    <div class="row">
        <div class="col-sm-6 col-md-4 col-md-offset-4 col-sm-offset-3">
            <div id="message" class="alert alert-success">
                {{ Session::get('error') }}
            </div>
        </div>
    </div>
    @endif

    <table class="table table-striped table-hover">
            <thread>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Date Created</th>
                <th>Permission</th>
            </thread>

            <tbody>
                @if($users)
                    @foreach($users as $user)
                        <!--  -->
                        <tr>
                            <th>{{ $loop->iteration }} </th>
                            <td>{{ $user->name }} </td>
                            <td>{{ $user->email }} </td>
                            <td>{{ Carbon\Carbon::parse($user->created_at)->format('d-m-Y') }} </td>
                            <td>
                                <a href="{{ url('/user-permission',$user->id) }}">
                                    <button type="button" class="btn btn-primary btn-sm">Manage</button>
                                </a>
                        </tr>
                    @endforeach
                @else 
                    <p class="text-center text-primary">No user found!</p>
                @endif
            </tbody>
        </table><Br>
</main>
</div>
@endsection