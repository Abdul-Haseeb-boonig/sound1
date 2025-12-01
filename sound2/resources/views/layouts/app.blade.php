<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sound - Music & Video Platform</title>
</head>
<body style="margin: 0; font-family: Arial, sans-serif; background-color: #f4f4f4;">
    <!-- Header -->
    <header style="background: #2c3e50; color: white; padding: 1rem 0; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">
        <div style="max-width: 1200px; margin: 0 auto; padding: 0 20px; display: flex; justify-content: space-between; align-items: center;">
            <h1 style="margin: 0; font-size: 1.8rem;">
                <a href="{{ route('home') }}" style="color: white; text-decoration: none;">Sound</a>
            </h1>
            <nav>
                <ul style="list-style: none; margin: 0; padding: 0; display: flex; gap: 2rem; align-items: center;">
                    <li><a href="{{ route('home') }}" style="color: white; text-decoration: none; padding: 0.5rem 1rem; border-radius: 4px; transition: background 0.3s;">Home</a></li>
                    <li><a href="{{ route('music.index') }}" style="color: white; text-decoration: none; padding: 0.5rem 1rem; border-radius: 4px; transition: background 0.3s;">Music</a></li>
                    <li><a href="{{ route('videos.index') }}" style="color: white; text-decoration: none; padding: 0.5rem 1rem; border-radius: 4px; transition: background 0.3s;">Videos</a></li>
                    @auth
                        @if(auth()->check() && auth()->user()->email === 'admin@sound.com')
                            <li><a href="{{ route('music.create') }}" style="color: white; text-decoration: none; padding: 0.5rem 1rem; background: #27ae60; border-radius: 4px;">Add Music</a></li>
                            <li><a href="{{ route('videos.create') }}" style="color: white; text-decoration: none; padding: 0.5rem 1rem; background: #27ae60; border-radius: 4px;">Add Video</a></li>
                        @endif
                        <li>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" style="background: #e74c3c; color: white; border: none; padding: 0.5rem 1rem; border-radius: 4px; cursor: pointer;">Logout</button>
                            </form>
                        </li>
                    @else
                        <li><a href="{{ route('login') }}" style="color: white; text-decoration: none; padding: 0.5rem 1rem; border-radius: 4px; background: #3498db;">Login</a></li>
                        <li><a href="{{ route('register') }}" style="color: white; text-decoration: none; padding: 0.5rem 1rem; border-radius: 4px; background: #3498db;">Register</a></li>
                    @endauth
                </ul>
            </nav>
        </div>
    </header>

    <!-- Messages -->
    <div style="max-width: 1200px; margin: 0 auto; padding: 0 20px;">
        @if(session('success'))
            <div style="background: #d4edda; color: #155724; padding: 12px; border: 1px solid #c3e6cb; border-radius: 4px; margin: 20px 0;">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div style="background: #f8d7da; color: #721c24; padding: 12px; border: 1px solid #f5c6cb; border-radius: 4px; margin: 20px 0;">
                {{ session('error') }}
            </div>
        @endif
    </div>

    <!-- Main Content -->
    <main style="min-height: calc(100vh - 200px);">
        <div style="max-width: 1200px; margin: 0 auto; padding: 20px;">
            @yield('content')
        </div>
    </main>

    <!-- Footer -->
    <footer style="background: #2c3e50; color: white; text-align: center; padding: 2rem 0; margin-top: 3rem;">
        <div style="max-width: 1200px; margin: 0 auto; padding: 0 20px;">
            <p style="margin: 0;">&copy; 2024 Sound - Music & Video Platform. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>