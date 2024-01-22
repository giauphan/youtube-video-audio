@extends('layout.app')
@push('seo')
        <title>Post kingking</title>
        <meta name="title" property="og:title" content="Post kingking" />
        <meta name="description" property="og:description" content="Post kingking" />
        <meta name="keywords"
            content="watch video online, Post kingking, online streaming, video player, ad-free video, high-quality video, video viewing experience" />
@endpush

@section('content')
      <page-posts :posts='@json($posts)' :categorys='@json($categoryBlog)'></page-posts>
    
@endsection
