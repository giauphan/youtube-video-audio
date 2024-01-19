@extends('layout.app')
@push('seo')
    @if (isset($video))
        <title>{{ $video['title'] }}</title>
        <meta name="title" property="og:title" content="{{ $video['title'] }}" />
        <meta name="url" property="og:url"
            content="{{ route('video.index', ['video' => $video['video_id'], 'type_video' => $video['type'] == 'video' ? 'web-video' : $video['type']]) }}" />
        <meta name="description" property="og:description" content="{{ $video['title'] }}" />
        <meta name="keywords"
            content="watch video online, {{ $video['title'] }}, online streaming, video player, ad-free video, high-quality video, video viewing experience" />
    @endif
@endpush

@section('content')
    <div className="mx-auto my-10 max-w-5xl px-4 sm:px-6 md:my-20 md:px-8">
        <div className="mb-10 flex flex-col  bg-gray-100 px-4 py-3">
            <h2 className="mb-4 text-xl font-bold"></h2>
            <ul className="flex flex-wrap gap-x-3 gap-y-2 text-gray-600">
                <li :key="category.id" className="font-semibold transition-all hover:text-primary-500"
                    v-for="category in categorys">
                    <a :href="route('posts.show', `?tag=${{$category.slug}}`)">{{ $category->name }}</a>
                </li>
            </ul>
        </div>
        <div className="flex flex-col justify-center gap-y-10">
            <div key={post.id} className="flex flex-col gap-4" v-for="post in posts">
                <h2
                    className="relative text-3xl font-bold transition-all before:absolute before:-start-10 before:top-0 before:text-gray-900/10 before:content-['#'] hover:text-primary-500 hover:before:text-primary-500 sm:text-4xl lg:text-5xl">
                    <a :href="route('posts.show', post.slug)">{post.title}</a>
                </h2>
                <p>{{ post . description }}</p>
                <div className="flex gap-6">
                    <div>
                        bởi
                        <strong className="ms-1">{{ post . user . name }}</strong>
                    </div>
                    <div className="flex gap-2">
                        <a :href="route('posts.show', [`?tag=${tag.slug}`])" :key="tag.id" v-for="tag in tags">
                            #{{ tags . name }}
                        </a>
                    </div>
                    <div>{{ post . published_at }}</div>
                </div>
            </div>
        </div>

        <Paginate :meta="posts.meta" />
    </div>
@endsection
