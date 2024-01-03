@extends('layout.app')

@section('content')
    <section class="my-10 ">
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-6 min-h-[300px]">
            @foreach ($getvideo as $key => $video)
                <a href="{{ route('video.index', ['video' => $key]) }}" class="flex flex-col gap-6">
                    <img src="{{ $video['thumbnail'] ?? null }}" class="object-cover w-full h-full rounded-lg"
                        alt="{{ Str::limit($video['title'], 40) }}" />
                    <h1 class="text-xl text-white font-bold bg-black h-full" id="title">{{ $video['title'] }}</h1>
                </a>
            @endforeach
        </div>
        
        <paginate-component :pagination='@json($getvideo)'></paginate-component>
    </section>
@endsection
