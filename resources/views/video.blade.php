@extends('layout.app')

@section('body')

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
            <label for="file">Video File:</label>
            <input type="text" name="url" id="">
            <button type="submit">Upload and Play</button>
        </form>
    </section>

@endsection
