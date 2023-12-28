@extends('layout.app')

@section('body')
    <section class="my-10">
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach ($getvideo as $key => $video)
                <a href="{{route('video.index',['video'=>$key])  }}" class="flex flex-col gap-6">
                    <img src="{{ $video['thumbnail'] ?? null }}" width="100%" height="360px"
                        class="aspect-video sm:h-[360px] rounded-lg" />
                    <h1 class="text-xl text-white font-bold bg-black" id="title">{{ $video['title'] }}</h1>
                </a>
            @endforeach
        </div>

        <paginate-component :pagination='@json($getvideo)' ></paginate-component>
    </section>
@endsection
