<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="google-adsense-account" content="ca-pub-4786723346423249">
    @stack('seo')
    <meta name="description" property="og:description"
        content="{{ __('Down video and Watch this amazing video on our platform. Explore the latest content and enjoy high-quality videos.') }}" />
    <!-- Scripts -->
    @vite(['resources/scss/app.scss', 'resources/js/app.js'])
    @routes
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-4786723346423249"
        crossorigin="anonymous"></script>
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-D9HRVNGT44"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-D9HRVNGT44');
    </script>

</head>

<body>
    <div id="app">
        <header-component :user='@json(Auth::user())' lable_sign="{{ __('Register') }}"
            lable_login="{{ __('Login') }}" lable="{{ __('Choose a language') }}" lable_logout="{{__('Logout')}}" csrf="{{csrf_token()}}">
     
            <li>
                <form action="{{ route('video.upload') }}" method="POST">
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
                    @if (session('success'))
                    <alert-component :type="'success'" :body="'{{ __(session('success')) }}'">
                    </alert-component>
                @endif
                    @csrf
                    <input-group-component class="border border-gray-700" placeholder="{{ __('Link video youtube') }}"
                        name="url" id="youtube"></input-group-component>
                </form>
            </li>

        </header-component>

        <main class="mx-auto max-w-7xl px-3 sm:px-5 ">
            @yield('content')
        </main>

        <footer-component>

            <div class="sm:flex sm:items-center sm:justify-between">

                <a class="text-lg font-semibold text-white" href="/"> KINGKING </a>
                <footer-linkgroup-component
                    class="flex flex-wrap items-center mb-6 text-sm text-gray-500 sm:mb-0 dark:text-gray-400">
                    <footer-link-component href="/" class="text-white">
                        {{ __('About') }}
                    </footer-link-component>
                    <footer-link-component href="{{ route('terms.policy') }}" class="text-white">
                        {{ __('Service Policy and Terms') }}
                    </footer-link-component>

                    <footer-link-component href="/" class="text-white">
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
@stack('js')