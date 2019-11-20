<nav class="navbar navbar-expand-lg navbar-dark bg-dark m-0">
    <a class="navbar-brand" href="#">PartyPlanner</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse ml-auto">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="{{  route('index') }}">Home</a>
            </li>
            @auth
                <li class="nav-item">
                    <a class="nav-link" href="{{  route('group_index') }}">Groups</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{  route('profile', ['user_id' => Auth::user()->id]) }}">Profile</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{  route('logout') }}">Logout</a>
                </li>
            @endauth
            @guest
                <li class="nav-item">
                    <a class="nav-link" href="{{  route('login') }}">Login</a>
                </li>
            @endguest
        </ul>
    </div>
</nav>