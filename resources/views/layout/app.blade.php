<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    @vite(['resources/scss/app.scss', 'resources/js/app.js'])
    @routes
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <!-- Replace with Tailwind CSS font imports if needed -->

</head>

<body>
    <div id="app">
        <header-component :user='@json(Auth::user())' lable_sign="{{ __('Register') }}"
        lable_login="{{ __('Login') }}" lable="{{ __('Choose a language') }}">
            <li>
                <form action="{{ route('video.upload') }}" method="post">
                    @if ($errors->any())
                        @foreach ($errors->all() as $error)
                            <alert-component :type="'error'" :body="'{{ __($error) }}'">
                            </alert-component>
                        @endforeach
                    @endif
                    @if (session('error'))
                        <alert-component :type="'error'" :body="'{{ __(session('error')) }}'">
                        </alert-component>
                    @endif
                    @csrf
                    <input-group-component class="border border-gray-700" placeholder="{{ __('Link video youtube') }}"
                        name="url"></input-group-component>
                </form>
            </li>


        </header-component>

        <main class="mx-auto max-w-7xl px-3 sm:px-5">
            @yield('body')
        </main>
    </div>
</body>

</html>
