@extends('layout.app')
@push('seo')
    @if (isset($video))
        <title>{{ $video['title'] }}</title>
        <meta name="title" property="og:title" content="{{ $video['title'] }}" />
        <meta name="url" property="og:url" content="{{ route('video.index', ['video' => $video['video_id']]) }}" />
        <meta name="description" property="og:description" content="{{ $video['title'] }}" />
        <meta name="keywords"
            content="watch video online, {{ $video['title'] }}, online streaming, video player, ad-free video, high-quality video, video viewing experience" />
    @endif
@endpush

@section('content')
    <section class=" gap-4 ">
            @if (isset($video) )
                    <video-component :video='@json($video)' :videos_drag='@json($ListVideo)' csrf="{{ csrf_token() }}" lable_delete="{{__('Delete')}}">
                        <form action="{{route('video.report')}}" method="post" class=" flex flex-end">
                            @csrf
                            <input type="hidden" name="type" value="{{ $video['type']}}">
                            <input type="hidden" name="link" value="{{ $video['video_id'] }}">
                            <button-component class="text-white " > {{__('Save in list Watch late')}}</button-component>
                        </form>
                        <form action="{{route('video.report')}}" method="post" class=" flex flex-end">
                            @csrf
                            <input type="hidden" name="type" value="{{ $video['type']}}">
                            <input type="hidden" name="link" value="{{ $video['video_id'] }}">
                            <button-component class="text-white "  iconposition="start" icon="FlagIcon">{{__('Report error video')}}</button-component>
                        </form>
                    </video-component>
            @endif
    </section>
@endsection

@push('js')
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-4786723346423249"
        crossorigin="anonymous"></script>
    <ins class="adsbygoogle" style="display:block" data-ad-client="ca-pub-4786723346423249" data-ad-slot="2165795039"
        data-ad-format="auto" data-full-width-responsive="true"></ins>
    <script>
        (adsbygoogle = window.adsbygoogle || []).push({});
    </script>
@endpush
