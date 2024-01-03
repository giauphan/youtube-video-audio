@extends('layout.app')

@section('content')
<div class="mt-10">
    <div class="flex flex-wrap justify-center">
        <div class="">
            <div class="card">
                <div class="text-2xl font-bold text-white">{{ __('Login') }}</div>

                <div class="mt-5">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="flex mb-3 gap-5">
                            <label for="email" class="text-white font-normal w-1/2">{{ __('Email Address') }}</label>

                            <div class="">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="flex gap-5 mb-3">
                            <label for="password" class="text-white font-normal w-1/2">{{ __('Password') }}</label>

                            <div class="">
                                <input id="password" type="password" class=" @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="text-white font-normal text-lg" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="flex flex-wrap gap-5 mb-0">
                            <div class="gap-5 flex items-center">
                                <button type="submit" class="bg-gray-700 p-2 rounded text-white text-xl font-semibold">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="text-white underline" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
