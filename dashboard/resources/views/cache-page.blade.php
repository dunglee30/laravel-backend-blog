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
            <div class="alert alert-danger">
                {{ Session::get('error') }}
                    @php
                        Session::forget('error');
                    @endphp
            </div>
        @endif

        <h1>
            Cache Configuration
        </h1>

        
        <br>

        <table class="table table-striped table-hover">
            <thread>
                <th>#</th>
                <th>URL</th>
                <th>Delete</th>
            </thread>

            <tbody>
                @if($urlList)
                    @foreach($urlList as $key)
                        <!--  -->
                        <tr>
                            <th>{{ $loop->iteration }} </th>
                            <td>{{ $key }} </td>
                            <td>
                                <a onclick="return confirm('Are you sure?')" href="{{ url('/user/delete-cache', [$key]) }}">
                                    <button type="button" class="btn btn-primary btn-sm"> Delete URL Cache </button>
                                </a>
                        </tr>
                    @endforeach
                @else 
                    <p class="text-center text-primary">No Posts created Yet!</p>
                @endif
            </tbody>
        </table>
        </br>
        @if($server)
            <h2>
                Current Server: {{$server}}
            </h2>
            </br>
        @endif
        <div class="col-md-4 cache-config-form">
            <form method="post" action="{{ url('/user/config-server') }}">
                @csrf
                <h2> Cache server configuration </h2>

                <input type="radio" id="redis" name="group_server" value="redis">
                <label for="redis"> Redis </label><br>
                <input type="radio" id="file" name="group_server" value="file">
                <label for="file"> File </label><br>
                <button type="submit" class="btn btn-primary"> Update Change </button>
                <!-- <input type="submit" id="submitButton" th:value="Update Change" name="submit" disabled="disabled" placeholder="Update Change"/> -->
            </form>
        </div>
    </main>

</div>
@endsection

@section('script')
@include('script.script-cache')
@endsection