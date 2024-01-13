@extends('layout.app')

@push('seo')
<title>{{ config('app.name', 'Laravel') }}</title>
<meta name="url" property="og:url" content="{{route('home')}}">
<meta name="title"  property="og:title" content="{{__('Download YouTube videos and watch without interruptions from ads. Explore an ad-free video viewing experience on our platform.')}}" />
<meta name="keywords" content="download YouTube videos, ad-free video, video streaming, watch videos without ads, video download platform, uninterrupted video, YouTube video download, high-quality videos, video viewing experience, ad-free streaming, watch videos offline" />

@endpush

@section('content')
    <section class="my-10 ">
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-6 min-h-[300px]">
            @foreach ($getvideo as $key => $video)
                <a href="{{route('video.index',['video'=>$video['video_id']])  }}" class="">
                    <img src="{{ $video['thumbnail'] ?? null }}" class="mb-5 aspect-video w-full h-56 rounded-lg" alt="{{ Str::limit($video['title'], 40) }}" />
                    <h1 class="text-xl text-white font-bold bg-black overflow-hidden" style="display: -webkit-box;
                    -webkit-box-orient: vertical;
                    -webkit-line-clamp: 2;">{{ $video['title'] }}</h1>
                </a>
            @endforeach
        </div>

        <paginate-component :pagination='@json($getvideo)' ></paginate-component>
    </section>
@endsection