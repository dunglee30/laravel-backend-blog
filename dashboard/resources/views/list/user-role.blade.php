@extends('master')


@section('content')
<div class="container-fluid">
@include('sidebar')

<main role="main" class="col-sm-9 ml-sm-auto col-md-10 pt-3">
    <h1>
        Users: {{$user->name}}
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
    <div class="role-area">
        <table class="table table-striped table-hover">
            <thread>
                <th>#</th>
                <th>Role</th>
                <th>Action</th>
            </thread>

            <tbody>
                @if($user)
                    @foreach($roles as $role)
                        <!--  -->
                        <tr>
                            <th>{{ $loop->iteration }} </th>
                            <td>{{ $role->slug }} </td>
                            <td>
                                <a href="{{ url('/delete-role',[$role->slug, $user->id]) }}">
                                    <button type="button" class="btn btn-primary btn-sm">Delete</button>
                                </a>
                        </tr>
                    @endforeach
                @else 
                    <p class="text-center text-primary">No user found!</p>
                @endif
            </tbody>
        </table><Br>
        <div class="col-md-4 role-form">
            <form method="post" action="{{ url('add-role', $user->id) }}">
                @csrf
                <h2> Role manage </h2>

                <input type="checkbox" id="role1" name="editor" value="editor">
                <label for="role1"> Editor </label><br>
                <input type="checkbox" id="role2" name="deleter" value="deleter">
                <label for="role2"> Edit </label><br>

                <button type="submit" class="btn btn-primary"> Update Change </button>
                <!-- <input type="submit" id="submitButton" th:value="Update Change" name="submit" disabled="disabled" placeholder="Update Change"/> -->

                
            </form>
            
        </div>
    </div>
</main>
</div>
@endsection

@section('script')
@include('script.script-permission')
@endsection