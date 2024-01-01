@extends('layout.app')
@push('seo')
    @if (isset($video))
        <title>{{$video['title']}}</title>
        <meta name="title" property="og:title" content="{{$video['title']}}" />
        <meta name="url"  property="og:url" content="{{route('video.index',['video'=>$video['id']])}}" />
        <meta name="description"  property="og:description" content="{{$video['title']}}" />
    @endif
@endpush
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
