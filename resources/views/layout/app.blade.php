<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="google-adsense-account" content="ca-pub-4786723346423249">
    @stack('seo')


    <!-- Scripts -->
    @vite(['resources/scss/app.scss', 'resources/js/app.js'])
    @routes
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <!-- Replace with Tailwind CSS font imports if needed -->
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-4786723346423249"
    crossorigin="anonymous"></script>
    
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

        <main class="mx-auto max-w-7xl px-3 sm:px-5 min-h-[400px]">
            @yield('body')
        </main>

        <footer-component>

            <div class="sm:flex sm:items-center sm:justify-between">

                <a class="text-lg font-semibold text-white" href="/"> KINGKING </a>
                <footer-linkgroup-component
                    class="flex flex-wrap items-center mb-6 text-sm text-gray-500 sm:mb-0 dark:text-gray-400">
                    <footer-link-component href="/">
                        {{ __('About') }}
                    </footer-link-component>
                    <footer-link-component href="{{ route('terms.polyci') }}" class="text-white">
                        {{ __('Service Policy and Terms') }}
                    </footer-link-component>

                    <footer-link-component href="/">
                        {{ __('Contact') }}
                    </footer-link-component>
                </footer-linkgroup-component>
            </div>
            <hr class="my-6 border-gray-200 sm:mx-auto dark:border-gray-700 lg:my-8">
            <div class="text-white text-center">
                {{ __('© 2023 Kingking All Rights Reserved.') }}
            </div>
        </footer-component>
    </div>
</body>

</html>
