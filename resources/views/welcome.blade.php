@extends('layouts.website')

@section('title', 'THE UNFILTERED, GLOBAL NEWS AGENCY')

@section('meta')
    <meta name="description" content="Stay updated with the latest news from The Unfiltered, Global News Agency. We provide unbiased and comprehensive news coverage.">
    <meta name="keywords" content="news, global news, unfiltered news, latest news, current events">
@endsection

@section('content')
<style>
    @keyframes moveLeftRight {
        0% { transform: translateX(100%); }
        100% { transform: translateX(-100%); }
    }

    .animate-horizontal {
        animation: moveLeftRight 10s linear infinite;
        white-space: nowrap;  
        display: inline-block;
    }
</style>

<div class="max-w-10xl mx-auto px-4 sm:px-6 lg:px-8 mt-16">
    <h1 class="font-extrabold text-purple-800 text-pretty text-lg text-center font-sans">Global Eye</h1>

    @if($latest)
        <h1 class="text-lg text-center font-bold text-green-300 animate-horizontal"> 
            <a href="{{ route('news.show', $latest->slug) }}" class="font-bold text-xl text-red-600 hover:underline animate-pulse">
                {{ $latest->title }}
            </a>
        </h1>
    @else
        <h1 class="text-lg text-white text-center font-bold bg-red-300">No Updates Available</h1>
    @endif
    
    <hr/>

    <main class="container text-start mx-auto bg-transparent mt-8 border-l-8 border-indigo-500">
        <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-3">
            @foreach($news as $item)
                <article class="mb-4 rounded-lg">
                    <a href="{{ route('news.show', $item->slug) }}" class="block p-4 mt-4">
                        <h2 class="text-xl font-bold text-blue-700">{{ $item->title }}</h2>
                        
                        <div class="flex flex-row gap-4 items-start mt-4">
                            <!-- Description -->
                            <p class="text-gray-900 text-xl font-bold flex-1 no-underline">
                                {{ $item->description }}
                            </p>
                            <!-- Image -->
                            @if($item->image_url)
                                <img src="{{ $item->image_url }}" alt="{{ $item->title }}" class="w-1/2 h-auto rounded">
                            @endif
                        </div>
                    </a>
                    <div class="flex flex-grow gap-2">
                        <p class="text-red-500 text-sm">{{ $item->created_at->diffForHumans() }}</p>
                        <p class="text-black">Posted by 
                            @if($item->user)
                                <span class="text-gray-800">{{ $item->user->name }}</span>
                            @else
                                <span class="text-gray-500">Anonymous</span>
                                
                            @endif
                        </p>
                    </div>
                </article>
            @endforeach
        </div>
    </main>

    <!-- Popular Posts Section -->
    <aside class="container mx-auto mt-12">
        <h2 class="text-2xl font-bold text-purple-800 text-center font-serif">Popular Posts</h2>
        <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-3">
            @foreach($popularPosts as $popular)
                <article class="mb-4 p-4 bg-gray-100 rounded-lg">
                    <a href="{{ route('news.show', $popular->slug) }}" class="block">
                        <h3 class="text-lg font-semibold text-blue-600">{{ $popular->title }}</h3>
                        <p class="text-sm text-gray-700 mt-2">
                            {{ Str::limit($popular->description, 100) }}
                        </p>
                        @if($popular->image_url)
                            <img src="{{ $popular->image_url }}" alt="{{ $popular->title }}" class="w-full h-auto mt-4 rounded">
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
