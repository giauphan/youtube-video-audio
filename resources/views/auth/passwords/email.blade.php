@extends('layout.app')

@section('content')
    <div class="mt-10">
        <div class="flex justify-center">
            <div class="md:w-8/12">
                <div class="bg-gap-700 shadow-md rounded-md p-8">
                    <div class="text-2xl font-semibold mb-6 text-white">{{ __('Reset Password') }}</div>

                    @if (session('status'))
                        <alert-component :type="'error'" :body="'{{ session('status') }}'">
                        </alert-component>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="email"
                                class="block text-md font-medium text-white">{{ __('Email Address') }}</label>
                            <input-component id="email" type="email"
                            class="form-input mt-1 block w-full  @error('email') border-red-500 @enderror" name="email"
                            value="{{ old('email') }}" required autocomplete="email" autofocus></input-component>

                            @error('email')
                                <span class="text-red-500 text-sm mt-1" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="flex items-center">
                            <div class="w-full md:w-6/12 lg:w-4/12 mx-auto">
                                <button type="submit" class="text-white bg-gray-700 text-xl p-2 rounded">
                                    {{ __('Send Password Reset Link') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
