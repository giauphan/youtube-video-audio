@extends('layout.app')

@section('content')
    <div class="mt-10 mx-auto">
        <div class="flex justify-center">
            <div class="md:w-8/12">
                <div class=" shadow-md rounded-md p-8">
                    <div class="text-2xl font-semibold text-white mb-6">{{ __('Register') }}</div>

                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="block text-md font-medium text-white">{{ __('Name') }}</label>
                            <input-component id="name" type="text"
                                class="form-input mt-1 block w-full @error('name') border-red-500 @enderror" name="name"
                                value="{{ old('name') }}" required autocomplete="name" autofocus> </input-component>

                                @error('name')
                                    <span class="text-red-500 text-sm mt-1" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email"
                                class="block text-md font-medium text-white">{{ __('Email Address') }}</label>
                            <input-component id="email" type="email"
                                class="form-input mt-1 block w-full @error('email') border-red-500 @enderror" name="email"
                                value="{{ old('email') }}" required autocomplete="email"></input-component>

                            @error('email')
                                <span class="text-red-500 text-sm mt-1" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="block text-md font-medium text-white">{{ __('Password') }}</label>
                            <input-component id="password" type="password"
                                class="form-input mt-1 block w-full @error('password') border-red-500 @enderror"
                                name="password" required autocomplete="new-password"> </input-component>

                            @error('password')
                                <span class="text-red-500 text-sm mt-1" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password-confirm"
                                class="block text-md font-medium text-white">{{ __('Confirm Password') }}</label>
                            <input-component id="password-confirm" type="password" class="form-input mt-1 block w-full"
                                name="password_confirmation" required autocomplete="new-password"></input-component>
                        </div>

                        <div class="flex items-center">
                            <div class="w-full md:w-6/12 lg:w-4/12 mx-auto">
                                <button type="submit" class="text-white bg-gray-700 p-2 rounded w-full">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
