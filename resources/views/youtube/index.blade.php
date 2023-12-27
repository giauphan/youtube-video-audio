@extends('layout.app')

@section('body')
    <section class="my-10">
        <div class="flex gap-4">
            <div class="flex flex-col gap-6">

                <video id="video" width="100%" height="360px" class=" sm:h-[360px] rounded-lg" controls>
                    <source src="{{ $url_video }}" type="video/mp4">
                </video>
                <h1 class="text-xl text-white font-bold bg-black">{{ $title }}</h1>
            </div>
            <div class="flex flex-col gap-4">
abc
            </div>
        </div>
    </section>
@endsection
