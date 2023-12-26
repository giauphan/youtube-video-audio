@extends('layout.app')

@section('body')
    <section class="my-10">
        <h1>{{ $title }}</h1>

        <video id="video" width="100%" height="500px" controls>
            <source src="{{ $url_video }}" type="video/mp4">
        </video>
    </section>
@endsection
