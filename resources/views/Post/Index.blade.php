@extends('layout.app')
@push('seo')
    @if (isset($video))
        <title>{{ $video['title'] }}</title>
        <meta name="title" property="og:title" content="{{ $video['title'] }}" />
        <meta name="url" property="og:url"
            content="{{ route('video.index', ['video' => $video['video_id'], 'type_video' => $video['type'] == 'video' ? 'web-video' : $video['type']]) }}" />
        <meta name="description" property="og:description" content="{{ $video['title'] }}" />
        <meta name="keywords"
            content="watch video online, {{ $video['title'] }}, online streaming, video player, ad-free video, high-quality video, video viewing experience" />
    @endif
@endpush

@section('content')
    <div className="mx-auto my-10 max-w-5xl px-4 sm:px-6 md:my-20 md:px-8">
       <page-post-category :categorys='@json($categoryBlog)'></page-post-category>
      <component-posts :posts='@json($posts)'> </component-posts>
    </div>
@endsection
