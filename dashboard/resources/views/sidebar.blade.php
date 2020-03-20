<div class="row">
        <nav class="col-sm-3 col-md-2 d-none d-sm-block sidebar">
            <ul class="navbar-nav flex-column">
                <li class="nav-item">
                    <a class="nav-link active" href="{{ url('user/posts') }}">{{ __('Your posts') }}</a>
                </li>
            </ul>
            <ul class="navbar-nav flex-column">
                <li class="nav-item">
                    <a class="nav-link active" href="{{ url('user/all-posts') }}">{{ __('Other posts') }}</a>
                </li>
            </ul>
            <ul class="navbar-nav flex-column">
                <li class="nav-item">
                    <a class="nav-link active" href="{{ url('user/user-list') }}">{{ __('Users') }}</a>
                </li>
            </ul>
        </nav>
    </div>