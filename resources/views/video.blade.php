@extends('layout.app')

@section('body')
    <section class="flex gap-4">
        <div>
            @if (isset($video))
                <section class="my-10">
                    <video-component :video='@json($video)'></video-component>
                </section>
            @endif

        </div>
        <div class="hidden sm:flex flex-col gap-4">
            abc
        </div>

    </section>
@endsection
