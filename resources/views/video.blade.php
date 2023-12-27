@extends('layout.app')

@section('body')
    <section class="flex gap-4">
        <div>
            @if (isset($url_video) && isset($title))
                <section class="my-10">
                    <div class="flex flex-col gap-6">

                        <video id="video" width="100%" height="360px" class="aspect-video sm:h-[360px] rounded-lg" controls>
                            <source src="{{ $url_video }}" type="video/mp4">
                        </video>
                        <h1 class="text-xl text-white font-bold bg-black">{{ $title }}</h1>
                    </div>
                </section>
            @endif

           
        </div>
        {{--  --}}
        <div class="flex flex-col gap-4">
            abc
        </div>

    </section>

@endsection
