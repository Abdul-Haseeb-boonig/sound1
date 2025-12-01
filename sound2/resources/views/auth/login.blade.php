@extends('layouts.app')

@section('content')
    <div style="max-width: 400px; margin: 0 auto;">
        <div style="background: white; border-radius: 10px; padding: 2rem; box-shadow: 0 3px 15px rgba(0,0,0,0.1);">
            <h2 style="color: #2c3e50; text-align: center; margin-bottom: 2rem;">Login to Sound</h2>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div style="margin-bottom: 1.5rem;">
                    <label for="email" style="display: block; margin-bottom: 0.5rem; color: #2c3e50; font-weight: bold;">Email Address</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus
                           style="width: 100%; padding: 0.75rem; border: 1px solid #ddd; border-radius: 5px; font-size: 1rem;">
                    @error('email')
                        <span style="color: #e74c3c; font-size: 0.9rem;">{{ $message }}</span>
                    @enderror
                </div>

                <div style="margin-bottom: 1.5rem;">
                    <label for="password" style="display: block; margin-bottom: 0.5rem; color: #2c3e50; font-weight: bold;">Password</label>
                    <input id="password" type="password" name="password" required autocomplete="current-password"
                           style="width: 100%; padding: 0.75rem; border: 1px solid #ddd; border-radius: 5px; font-size: 1rem;">
                    @error('password')
                        <span style="color: #e74c3c; font-size: 0.9rem;">{{ $message }}</span>
                    @enderror
                </div>

                <div style="margin-bottom: 1.5rem;">
                    <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}
                           style="margin-right: 0.5rem;">
                    <label for="remember" style="color: #2c3e50;">Remember Me</label>
                </div>

                <button type="submit" 
                        style="width: 100%; background: #3498db; color: white; border: none; padding: 1rem; border-radius: 5px; cursor: pointer; font-size: 1.1rem; font-weight: bold;">
                    Login
                </button>

                @if (Route::has('password.request'))
                    <div style="text-align: center; margin-top: 1rem;">
                        <a href="{{ route('password.request') }}" style="color: #3498db; text-decoration: none;">Forgot Your Password?</a>
                    </div>
                @endif

                <div style="text-align: center; margin-top: 1.5rem; padding-top: 1.5rem; border-top: 1px solid #eee;">
                    <p style="color: #666; margin: 0;">Don't have an account? 
                        <a href="{{ route('register') }}" style="color: #3498db; text-decoration: none; font-weight: bold;">Register here</a>
                    </p>
                </div>
            </form>
        </div>
    </div>
@endsection