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
        <header-component>
            @guest
                @if (Route::has('login'))
                    <li>
                        <a class="text-gray-600 hover:text-gray-900" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                @endif

                @if (Route::has('register'))
                    <li>
                        <a class="text-gray-600 hover:text-gray-900" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>
                @endif
            @else
                <drop-down-component name="{{ Auth::user()->name }}">

                </drop-down-component>

            @endguest
        </header-component>

        <main class="mx-auto max-w-7xl ">
            @yield('body')
        </main>
    </div>
</body>

</html>
