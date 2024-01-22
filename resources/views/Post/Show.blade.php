@extends('layout.app')
@push('seo')
        <title>{{ $posts['title'] }}</title>
        <meta name="title" property="og:title" content="{{ $posts['title'] }}" />
        <meta name="url" property="og:url"
            content="{{ route('posts.show',['slug'=> $posts['slug']]) }}" />
        <meta name="description" property="og:description" content="{{ $posts['title'] }}" />
        <meta name="keywords"
            content="watch posts online, {{ $posts['title'] }}, online streaming, video player, ad-free video, high-quality video, video viewing experience" />
@endpush

@section('content')
      <page-posts-show :post='@json($posts)'> </page-posts-show>
    
@endsection
