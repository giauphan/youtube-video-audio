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
      <page-posts-show :post='@json($posts)'> </page-posts-show>
    
@endsection
