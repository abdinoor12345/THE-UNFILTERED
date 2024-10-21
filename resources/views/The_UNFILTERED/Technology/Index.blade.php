@extends('layouts.website')

@section('title', 'technology ,hardware,software,programming,python')

@section('meta')
    <meta name="description" content="Stay updated with the latest news from The Unfiltered, Global News Agency. We provide unbiased and comprehensive news coverage.">
    <meta name="keywords" content="news, global news, unfiltered news, latest news, current events, technology">
@endsection

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-16">
    <main class="container mx-auto bg-transparent mt-8">
        
        @if ($latest)
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
            <!-- First post covering half the page -->
            <div class="col-span-1 lg:col-span-2">
                <article class="mb-8 p-6 rounded-lg bg-green-300 shadow-lg">
                    <a href="{{ route('technology.show', $latest->slug) }}">
                        <h1 class="text-3xl font-bold text-red-800 mb-4 animate-pulse">{{ $latest->title }}</h1>
                        <div class="flex flex-row gap-4">
                            <p class="text-gray-900 text-lg flex-1">{{ $latest->description }}</p>
                             
                        </div>
                    </a>
                </article>
            </div>

            <!-- Remaining posts filling the rest -->
            @foreach($news as $item)
            <article class="    p-4">
                <a href="{{ route('technology.show', $item->slug) }}">
                    <h2 class="text-xl font-bold text-blue-700">{{ $item->title }}</h2>
                    <p class="text-gray-700 mt-2 font-extrabold">{{ $item->description }}</p>
                    @if($item->image_url)
                    <img src="{{ $item->image_url }}" alt="{{ $item->title }}" class="w-full h-auto mt-4 rounded-lg">
                    @endif
                    <div class="flex flex-grow gap-4 item-center border-l-2 border-red-700">    
                        <p class="text-gray-500 text-sm">   Posted:{{ $item->created_at->diffForHumans() }}</p>
                            @if($item->user)
           <span class="  text-green-300 text-sm font-bold"> Posted by: {{$item->user->name}}</span>@else
           Posted by: <span class="text-gray-200 text-sm font-bold">Anonymous</span>
            @endif</div>
                </a>
            </article>
            @endforeach
        </div>
        
        <!-- Pagination links -->
        
        @else
        <h1 class="text-lg text-white text-center font-bold bg-red-300">No Updates</h1>
        @endif
    </main>
    <aside class="container mx-auto mt-12">
        <h2 class="text-2xl font-bold text-purple-800 text-center font-serif">Popular Posts</h2>
        <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-3">
            @foreach($popularPosts as $popular)
                <article class="mb-4 p-4 bg-gray-100 rounded-lg">
                    <a href="{{ route( 'top_stories.show', $popular->slug) }}" class="block">
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
