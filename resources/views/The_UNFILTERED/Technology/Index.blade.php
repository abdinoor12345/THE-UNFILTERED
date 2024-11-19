@extends('layouts.website')

@section('title', 'technology, hardware, software, programming, python')

@section('meta')
    <meta name="description" content="Stay updated with the latest news from The Unfiltered, Global News Agency. We provide unbiased and comprehensive news coverage.">
    <meta name="keywords" content="news, global news, unfiltered news, latest news, current events, technology">
@endsection

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-16">
    <main class="container mx-auto bg-transparent mt-8">
        <div class="flex flex-row gap-2 bg-slate-100 text-blue-900 font-medium the mb-6 px-6 overflow-x-scroll md:justify-center lg:hidden">
            <p>DevOps</p>
            <p>PROGRAMMING</p>
            <P>HARDWARE</P>
            <P>HOSTING</P>
        </div>
        @if ($latest)
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- First post covering half the page -->
            <div class="col-span-1 lg:col-span-2">
                <article class="mb-8 p-6 rounded-lg bg-green-300 shadow-lg transition duration-300 hover:shadow-xl">
                    <a href="{{ route('technology.show', $latest->slug) }}">
                        <h1 class="text-2xl font-bold text-red-800 mb-4 animate-pulse">{{ Str::limit($latest->title ,50) }}</h1>
                        <div class="flex flex-row gap-4">
                            <!-- Placeholder for any additional content if needed -->
                        </div>
                    </a>
                </article>
            </div>

            <!-- Remaining posts filling the rest -->
            @foreach($news as $item)
            <article class="p-4 bg-white rounded-lg shadow-md hover:shadow-lg transition duration-300">
                <a href="{{ route('technology.show', $item->slug) }}">
                    <h2 class="text-xl font-bold text-blue-700 hover:text-blue-800">{{ $item->title }}</h2>
                    <p class="text-gray-700 mt-2 font-extrabold">{{ $item->description }}</p>
                    @if($item->image_url)
                    <img src="{{ $item->image_url }}" alt="{{ $item->title }}" class="w-full h-auto mt-4 rounded-lg">
                    @endif
                    <div class="flex flex-grow gap-4 items-center mt-2 text-gray-500">    
                        <p class="text-sm">Posted: {{ $item->created_at->diffForHumans() }}</p>
                        @if($item->user)
                            <span class="text-green-500 text-sm font-bold">Posted by: {{ $item->user->name }}</span>
                        @else
                            <span class="text-gray-400 text-sm font-bold">Posted by: Anonymous</span>
                        @endif
                    </div>
                </a>
            </article>
            @endforeach
        </div>
        
        @else
        <h1 class="text-lg text-white text-center font-bold bg-red-300 p-4 rounded-md shadow-md">No Updates</h1>
        @endif
    </main>

    <!-- Share Buttons Section -->
    <div class="social-btn-sp text-center py-6 bg-gray-50 rounded-md shadow-sm mt-8">
        <h1 class="text-primary text-lg font-semibold">Share Our Content</h1>
        <div class="flex justify-center space-x-6 text-red-600 mt-3">
            {!! $shareButtons !!}
        </div>
    </div>

    <!-- Popular Posts Section -->
    <aside class="container mx-auto mt-12">
        <h2 class="text-2xl font-bold text-purple-800 text-center font-serif mb-6">Popular Posts</h2>
        <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
            @foreach($popularPosts as $popular)
                <article class="p-6 bg-gray-100 rounded-lg shadow-lg transition duration-300 hover:bg-gray-200">
                    <a href="{{ route('technology.show', $popular->slug) }}" class="block">
                        <h3 class="text-lg font-semibold text-blue-600 hover:text-blue-700">{{ $popular->title }}</h3>
                        <p class="text-sm text-gray-700 mt-2">
                            {{ Str::limit($popular->description, 100) }}
                        </p>
                        @if($popular->image_url)
                            <img src="{{ $popular->image_url }}" alt="{{ $popular->title }}" class="w-full h-auto mt-4 rounded">
                        @endif
                    </a>
                    <div class="text-sm text-gray-500 mt-3 flex justify-between items-center">
                        <span>{{ $popular->created_at->diffForHumans() }}</span>
                        <span>{{ $popular->views }} views</span>
                    </div>
                </article>
            @endforeach
        </div>
    </aside>
</div>
@endsection
