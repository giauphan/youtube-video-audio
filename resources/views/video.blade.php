@extends('layout.app')

@section('body')
    <section class="flex gap-4">
        <div>
            @if (isset($url_video) && isset($title))
                <section class="my-10">
                    <video-component url_video="{{ $url_video }}" title="{{ $title }}"></video-component>
                </section>
            @endif

        </div>
        {{--  --}}
        <div class="flex flex-col gap-4">
            abc
        </div>

    </section>
@endsection
