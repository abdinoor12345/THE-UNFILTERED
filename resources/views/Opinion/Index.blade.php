@extends('layouts.website')

@section('title', 'THE UNFILTERED, Opinions, Trending')

@section('meta')
    <meta name="description" content="Stay updated with the latest news from The Unfiltered, Global News Agency. We provide unbiased and comprehensive news coverage.">
    <meta name="keywords" content="news, global news, unfiltered news, latest news, current events, Trending, opinions">
@endsection

@section('content')
    <div class="max-w-9xl mx-auto px-4 sm:px-6 lg:px-8 mt-16 font-serif text-gray-900 bg-gray-100">
        
        @if ($latest)
            <h1 class="text-lg text-center font-bold bg-green-300 py-3 rounded shadow-sm">
                <a href="{{ route('opinions.show', $latest->slug) }}" class="text-blue-600 hover:text-blue-800 transition duration-200 ease-in-out">
                    {{ $latest->title }}
                </a>
            </h1>
        @else
            <h1 class="text-lg text-center font-bold bg-red-300 py-3 rounded shadow-sm">No Updates</h1>
        @endif
         
        <main class="container mx-auto bg-transparent mt-8">
            <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
                @foreach($news as $item)
                    <article class="mb-6 rounded-lg shadow-lg bg-white p-6 hover:bg-gray-50 transition transform hover:-translate-y-1 hover:shadow-2xl duration-300">
                        <a href="{{ route('opinions.show', $item->slug) }}" class="block">
                            <header>
                                <h2 class="text-xl font-bold text-blue-700 hover:text-blue-900 transition">{{ $item->title }}</h2>
                                <div class="flex items-center gap-4 mt-2 text-gray-500 text-sm">    
                                    <p>Posted: {{ $item->created_at->diffForHumans() }}</p>
                                    <span class="text-gray-400 font-bold">
                                        {{ $item->user ? 'Posted by: ' . $item->user->name : 'Posted by: Anonymous' }}
                                    </span>
                                </div>
                                <p class="text-gray-700 mt-3 font-semibold">{{ $item->description }}</p>
                            </header>
                            @if($item->image_url)
                                <img src="{{ $item->image_url }}" alt="{{ $item->title }}" class="w-full h-auto mt-4 rounded-lg">
                            @endif
                        </a>
                    </article>
                @endforeach
            </div>
        </main>

        <div class="social-btn-sp text-center py-6">
            <h1 class="text-lg font-bold text-blue-600 bg-zinc-50 p-4 rounded shadow-md">Share Our Contents</h1>
            <div class="flex justify-center space-x-8 text-red-600">
                {!! $shareButtons !!}
            </div>
        </div>

        <aside class="container mx-auto mt-12">
            <h2 class="text-2xl font-bold text-purple-800 text-center font-serif mb-8">Popular Posts</h2>
            <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
                @foreach($popularPosts as $popular)
                    <article class="bg-gray-100 p-6 rounded-lg shadow-md hover:shadow-lg transition duration-300 ease-in-out">
                        <a href="{{ route('opinions.show', $popular->slug) }}" class="block">
                            <h3 class="text-lg font-semibold text-blue-600 hover:text-blue-800">{{ $popular->title }}</h3>
                            <p class="text-sm text-gray-700 mt-2">{{ Str::limit($popular->description, 100) }}</p>
                            @if($popular->image_url)
                                <img src="{{ $popular->image_url }}" alt="{{ $popular->title }}" class="w-full h-auto mt-4 rounded-lg">
                            @endif
                        </a>
                        <div class="text-sm text-gray-500 mt-2">
                            <span>{{ $popular->created_at->diffForHumans() }}</span> • 
                            <span>{{ $popular->views }} views</span>
                        </div>
                    </article>
                @endforeach
            </div>
        </aside>
    </div>
@endsection
