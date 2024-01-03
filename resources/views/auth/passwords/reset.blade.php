@extends('layout.app')

@section('content')
<div class="container mx-auto">
    <div class="flex justify-center">
        <div class="w-full md:w-8/12 lg:w-6/12">
            <div class="bg-white shadow-md rounded-md p-8">
                <div class="text-xl font-semibold mb-6">{{ __('Reset Password') }}</div>

                <form method="POST" action="{{ route('password.update') }}">
                    @csrf

                    <input type="hidden" name="token" value="{{ $token }}">

                    <div class="mb-6">
                        <label for="email" class="block text-md font-medium text-white">{{ __('Email Address') }}</label>
                        <input id="email" type="email" class="form-input mt-1 block w-full @error('email') border-red-500 @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                        @error('email')
                            <span class="text-red-500 text-sm mt-1" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label for="password" class="block text-md font-medium text-gray-700">{{ __('Password') }}</label>
                        <input id="password" type="password" class="form-input mt-1 block w-full @error('password') border-red-500 @enderror" name="password" required autocomplete="new-password">

                        @error('password')
                            <span class="text-red-500 text-sm mt-1" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label for="password-confirm" class="block text-md font-medium text-gray-700">{{ __('Confirm Password') }}</label>
                        <input id="password-confirm" type="password" class="form-input mt-1 block w-full" name="password_confirmation" required autocomplete="new-password">
                    </div>

                    <div class="flex items-center">
                        <div class="w-full md:w-6/12 lg:w-4/12 mx-auto">
                            <button type="submit" class="text-white text-xl w-full">
                                {{ __('Reset Password') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
