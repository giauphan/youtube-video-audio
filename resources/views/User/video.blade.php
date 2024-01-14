@extends('layout.app')

@section('content')
    <section class="my-10 ">
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-2 min-h-[300px]">
            @foreach ($getvideo as $key => $video)
                <a href="{{ route('video.index', ['video' => $key]) }}" class="flex flex-col gap-2">
                    <img src="{{ $video['thumbnail'] ?? null }}" class=" aspect-video w-full max-h-[224px] rounded-lg"
                        alt="{{ Str::limit($video['title'], 40) }}" />
                    <h1 class="text-xl text-white font-bold bg-black overflow-hidden title">{{ $video['title'] }}</h1>
                    <form action="{{route('videoList.delete')}}" method="post">
                    @csrf
                        <input type="hidden" name="video_id" value="{{$video['video_id']}}" />
                        <button-component class="text-white">Delete</button-component>
                      </form>
                </a>
            @endforeach
        </div>
        
        <paginate-component :pagination='@json($getvideo)'></paginate-component>
    </section>
@endsection
