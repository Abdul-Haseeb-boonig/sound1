<!DOCTYPE html>
<html>
<head>
    <title>Sound - Music & Video</title>
</head>
<body>
    <nav>
        <h1>Sound</h1>
        <ul>
            <li><a href="{{ route('home') }}">Home</a></li>
            <li><a href="{{ route('music.index') }}">Music</a></li>
            <li><a href="{{ route('videos.index') }}">Videos</a></li>
            @auth
                @if(auth()->check() && auth()->user()->email === 'admin@sound.com')
                    <li><a href="{{ route('music.create') }}">Add Music</a></li>
                    <li><a href="{{ route('videos.create') }}">Add Video</a></li>
                @endif
                <li>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit">Logout</button>
                    </form>
                </li>
            @else
                <li><a href="{{ route('login') }}">Login</a></li>
                <li><a href="{{ route('register') }}">Register</a></li>
            @endauth
        </ul>
    </nav>

    @if(session('success'))
        <div style="background: green; color: white; padding: 10px;">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div style="background: red; color: white; padding: 10px;">
            {{ session('error') }}
        </div>
    @endif

    <main>
        @yield('content')
    </main>
</body>
</html>