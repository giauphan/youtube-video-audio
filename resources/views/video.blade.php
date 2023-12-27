@extends('layout.app')

@section('body')

    @if (isset($url_video) && isset($title))
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
    @endif

    <section class="my-10">
        <form action="{{ route('video.upload') }}" method="post">
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <li class="text-red-600">{{ $error }}</li>
                @endforeach
            @endif
            @if (session('error'))
                <li class="text-red-600">{{ session('error') }}</li>
            @endif
            @csrf
            <input-component class=" border hover:border-gray-700 focus:border-gray-800 border-gray-800"
                :lable="'Đường dẫn video youtube'" :id="'video'" :name="'url'"></input-component>
            <button-component :color="'gray'" class="mt-5 rounded">{{ __('Upload and Play') }}</button-component>
        </form>
    </section>

@endsection
