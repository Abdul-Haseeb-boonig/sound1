@extends('layouts.app')

@section('content')
    <div style="max-width: 500px; margin: 0 auto;">
        <div style="background: white; border-radius: 10px; padding: 2rem; box-shadow: 0 3px 15px rgba(0,0,0,0.1);">
            <h2 style="color: #2c3e50; text-align: center; margin-bottom: 2rem;">Join Sound</h2>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div style="margin-bottom: 1.5rem;">
                    <label for="name" style="display: block; margin-bottom: 0.5rem; color: #2c3e50; font-weight: bold;">Name *</label>
                    <input id="name" type="text" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus
                           style="width: 100%; padding: 0.75rem; border: 1px solid #ddd; border-radius: 5px; font-size: 1rem;">
                    @error('name')
                        <span style="color: #e74c3c; font-size: 0.9rem;">{{ $message }}</span>
                    @enderror
                </div>

                <div style="margin-bottom: 1.5rem;">
                    <label for="email" style="display: block; margin-bottom: 0.5rem; color: #2c3e50; font-weight: bold;">Email Address *</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="email"
                           style="width: 100%; padding: 0.75rem; border: 1px solid #ddd; border-radius: 5px; font-size: 1rem;">
                    @error('email')
                        <span style="color: #e74c3c; font-size: 0.9rem;">{{ $message }}</span>
                    @enderror
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 1.5rem;">
                    <div>
                        <label for="password" style="display: block; margin-bottom: 0.5rem; color: #2c3e50; font-weight: bold;">Password *</label>
                        <input id="password" type="password" name="password" required autocomplete="new-password"
                               style="width: 100%; padding: 0.75rem; border: 1px solid #ddd; border-radius: 5px; font-size: 1rem;">
                        @error('password')
                            <span style="color: #e74c3c; font-size: 0.9rem;">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label for="password-confirm" style="display: block; margin-bottom: 0.5rem; color: #2c3e50; font-weight: bold;">Confirm Password *</label>
                        <input id="password-confirm" type="password" name="password_confirmation" required autocomplete="new-password"
                               style="width: 100%; padding: 0.75rem; border: 1px solid #ddd; border-radius: 5px; font-size: 1rem;">
                    </div>
                </div>

                <div style="margin-bottom: 1.5rem;">
                    <label for="address" style="display: block; margin-bottom: 0.5rem; color: #2c3e50; font-weight: bold;">Address (Optional)</label>
                    <textarea id="address" name="address" 
                              style="width: 100%; padding: 0.75rem; border: 1px solid #ddd; border-radius: 5px; font-size: 1rem; min-height: 80px;">{{ old('address') }}</textarea>
                    @error('address')
                        <span style="color: #e74c3c; font-size: 0.9rem;">{{ $message }}</span>
                    @enderror
                </div>

                <div style="margin-bottom: 2rem;">
                    <label for="phone" style="display: block; margin-bottom: 0.5rem; color: #2c3e50; font-weight: bold;">Phone Number (Optional)</label>
                    <input id="phone" type="text" name="phone" value="{{ old('phone') }}"
                           style="width: 100%; padding: 0.75rem; border: 1px solid #ddd; border-radius: 5px; font-size: 1rem;">
                    @error('phone')
                        <span style="color: #e74c3c; font-size: 0.9rem;">{{ $message }}</span>
                    @enderror
                </div>

                <button type="submit" 
                        style="width: 100%; background: #27ae60; color: white; border: none; padding: 1rem; border-radius: 5px; cursor: pointer; font-size: 1.1rem; font-weight: bold;">
                    Create Account
                </button>

                <div style="text-align: center; margin-top: 1.5rem; padding-top: 1.5rem; border-top: 1px solid #eee;">
                    <p style="color: #666; margin: 0;">Already have an account? 
                        <a href="{{ route('login') }}" style="color: #3498db; text-decoration: none; font-weight: bold;">Login here</a>
                    </p>
                </div>
            </form>
        </div>
    </div>
@endsection