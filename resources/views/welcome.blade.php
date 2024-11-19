@extends('layouts.website')

@section('title', 'The Unfiltered, Global News Agency')

@section('meta')
    <meta name="description" content="Stay updated with the latest news from The Unfiltered, Global News Agency. We provide unbiased and comprehensive news coverage.">
    <meta name="keywords" content="news, global news, unfiltered news, latest news, current events">
@endsection

@section('content')
<style></style>

<div class="max-w-8xl mx-auto px-4 sm:px-6 lg:px-8 mt-12 ">
    <h1 class="text-3xl font-extrabold text-center text-indigo-800">Welcome to Global Eye</h1>

    <div class="my-6 text-center ml-2">
        @if($latest)
            <h2 class="text-xl font-semibold text-green-600 animate-pulse">
                <a href="{{ route('news.show', $latest->slug) }}" class="hover:underline">{{ $latest->title }}</a>
            </h2>
        @else
            <p class="text-lg text-red-600 font-medium">No Updates Available</p>
        @endif
    </div>

    <hr class="my-8"/>

    <main class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($news as $item)
            <article class="rounded-lg shadow-md bg-white p-6 hover:shadow-lg transition-shadow duration-200">
                <a href="{{ route('news.show', $item->slug) }}" class="block">
                    <h2 class="text-xl font-semibold text-blue-700">{{ $item->title }}</h2>
                    <p class="mt-3 text-gray-700">{{ Str::limit($item->description, 120) }}</p>
                    @if($item->image_url)
                        <img src="{{ $item->image_url }}" alt="{{ $item->title }}" class="mt-4 w-full h-40 object-cover rounded">
                    @endif
                </a>
                <div class="mt-4 text-sm text-gray-500">
                    <span>{{ $item->created_at->diffForHumans() }}</span> by 
                    <span class="font-medium">{{ $item->user ? $item->user->name : 'Anonymous' }}</span>
                </div>
            </article>
        @endforeach
    </main>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-8 mt-12">
        @foreach($videos as $video)
            <div>
                <h3 class="text-lg font-bold text-blue-800">{{ $video['title'] }}</h3>
                <div class="aspect-w-16 aspect-h-9 mt-4">
                    <iframe src="{{ $video['url'] }}" class="w-full h-full rounded-lg" allowfullscreen></iframe>
                </div>
            </div>
        @endforeach
    </div>

    <div class="my-8 text-center">
        <h2 class="text-lg font-bold text-gray-800">Share Our Content</h2>
        <div class="mt-4 social-btn-sp">
            {!! $shareButtons !!}
        </div>
    </div>
    <h2 class="text-2xl font-bold text-center text-green-800 italic">Featured Posts</h2>


    <aside class="mt-12">
        <h2 class="text-2xl font-bold text-center text-purple-800">Popular Posts</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-8">
            @foreach($popularPosts as $popular)
                <article class="p-4 bg-gray-50 rounded-lg shadow-sm hover:shadow-md transition-shadow duration-200">
                    <a href="{{ route('news.show', $popular->slug) }}" class="block">
                        <h3 class="text-lg font-semibold text-blue-600">{{ $popular->title }}</h3>
                        <p class="mt-2 text-gray-600">{{ Str::limit($popular->description, 80) }}</p>
                        @if($popular->image_url)
                            <img src="{{ $popular->image_url }}" alt="{{ $popular->title }}" class="w-full h-32 object-cover rounded mt-4">
                        @endif
                    </a>
                    <div class="text-xs text-gray-500 mt-3">
                        <span>{{ $popular->created_at->diffForHumans() }}</span> • 
                        <span>{{ $popular->views }} views</span>
                    </div>
                </article>
            @endforeach
        </div>
    </aside>
</div>
@endsection
