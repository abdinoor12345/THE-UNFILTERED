@extends('layouts.website')

@section('title', 'THE UNFILTERED, Top Stories, Trending')

@section('meta')
    <meta name="description" content="Stay updated with the latest news from The Unfiltered, Global News Agency. We provide unbiased and comprehensive news coverage.">
    <meta name="keywords" content="news, global news, unfiltered news, latest news, current events, T">
@endsection

@section('content')
<div class="max-w-8xl mx-auto px-4 sm:px-6 lg:px-8 mt-16">
    <main class="container mx-auto bg-transparent mt-8">
        
        @if ($latest)
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
            <!-- First post covering half the page -->
            <div class="col-span-1 lg:col-span-2    ">
                <article class="mb-8 p-6 rounded-lg bg-green-300 shadow-lg">
                    <a href="{{ route('top_stories.show', $latest->slug) }}">
                        <h1 class="text-3xl font-bold text-white mb-4">{{ $latest->title }}</h1>
                        <div class="flex flex-row gap-4">
                            <p class="text-gray-900 text-lg flex-1 font-extrabold">{{ $latest->description }}</p>
                             
                        </div>
                    </a>
                </article>
            </div>

            <!-- Remaining posts filling the rest -->
            @foreach($news as $item)
            <article class="    p-4">
                <a href="{{ route('top_stories.show', $item->slug) }}">
                    <h2 class="text-xl font-bold text-blue-700  ">{{ $item->title }}</h2>
                    <p class="text-gray-900 mt-2 text-xl font-extrabold ">{{ $item->description }}</p>
                    @if($item->image_url)
                    <img src="{{ $item->image_url }}" alt="{{ $item->title }}" class="w-full h-auto mt-4 rounded-lg">
                    @endif
                </a>
                <div class="flex flex-grow gap-4 item-center  ">    
                    <p class="text-black text-sm">   Posted:{{ $item->created_at->diffForHumans() }}</p>
                        @if($item->user)
       <span class="  text-green-800 text-sm "> Posted by: {{$item->user->name}}</span>@else
       Posted by: <span class="text-black text-sm font-bold">Anonymous</span>
        @endif</div>
            </article>
            @endforeach
        </div>
        
        <!-- Pagination links -->
        <div class="mt-8">
            {{ $news->links() }}
        </div>
        @else
        <h1 class="text-lg text-white text-center font-bold bg-red-300">No Updates</h1>
        @endif
    </main>  <div class="social-btn-sp text-center py-4">
        <h1 class="text-primary text-center text-lg">Share Our Contents</h1>
        <div class="flex justify-center space-x-8 text-red-600">
            {!! $shareButtons !!}
        </div>
    </div>
    
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
