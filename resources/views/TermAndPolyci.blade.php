@extends('layout.app')

@section('body')
    <section class="my-10">
        <h1 class="text-white text-center text-2xl">{{ __('Service Policy and Terms') }}</h1>
        <div class="flex flex-col gap-3">
            <p class="text-white text-xl">
                <span class="me-2">1.</span>{{ __('Service Description') }}:
            </p>
            <p class="text-white text-lg">
                {{ __('Currently, we provide users with the ability to submit links to YouTube videos, and we will return the corresponding video to the user.') }}
            </p>
            <p class="text-white text-xl">
                <span class="me-2">2.</span>{{ __('Supported Video Types') }}:
            </p>
            <p class="text-white text-lg">
                {{ __('We only process regular YouTube video links (not live streams) and YouTube Shorts.') }}
            </p>
            <p class="text-white text-xl">
                <span class="me-2">3.</span>{{__('Limitations')}}:
            </p>
            <p class="text-white text-lg">
                {{__('Currently, we only support links to YouTube videos.')}}
              </p>
        </div>
    </section>
@endsection
