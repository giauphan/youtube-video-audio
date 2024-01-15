@extends('layout.app')

@push('seo')
<title>{{ config('app.name', 'Laravel') }}</title>
<meta name="url" property="og:url" content="{{route('home')}}">
<meta name="title"  property="og:title" content="{{__('Download YouTube videos and watch without interruptions from ads. Explore an ad-free video viewing experience on our platform.')}}" />
<meta name="keywords" content="download YouTube videos, ad-free video, video streaming, watch videos without ads, video download platform, uninterrupted video, YouTube video download, high-quality videos, video viewing experience, ad-free streaming, watch videos offline" />

@endpush

@section('content')
      <page-home :videos='@json($videos)' :video_short='@json($shortVideo)'></page-home>
@endsection