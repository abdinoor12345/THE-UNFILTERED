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
<hr/>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-8 mt-12">
        @foreach($videos as $video)
            <div>
                <h3 class="text-lg font-bold text-blue-800">{{ $video['title'] }}</h3>
                <p class="text-lemon-600">{{ Str::limit($video->description, 100) }}</p>

                 <div class="aspect-w-16 aspect-h-9 mt-4">
    <video id="player" playsinline>
        <source src="{{ $video['url'] }}" type="video/mp4" />
    </video>
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
<div class="grow">
<div class="grid gap-4 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-4">
    @foreach($featuredPosts as $featured)
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            @if($featured->image_url)
                <img src="{{ $featured->image_url }}" class="w-full h-48 object-cover" alt="Image for {{ $featured->title }}">
            @else
                <a href="/">
                    <img src="{{ asset('Images/THE UNFILTERED.png') }}" alt="The Unfiltered Logo" class="w-full object-cover h-auto mr-4">
                </a>
            @endif
            <div class="p-4">
                <h5 class="text-lg font-bold">{{ $featured->title }}</h5>
                <p class="text-gray-700">{{ Str::limit($featured->description, 100) }}</p>
                <div class="mt-4 flex justify-between items-center">
                    <a href="{{ route('sponsereds.show', $featured->slug) }}" class="bg-blue-500 text-white px-3 py-1 rounded">View</a>
                 </div>
            </div>
        </div>
    @endforeach
</div>
</div>
<hr/>

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
<hr/>
<h1 class="text-center text-light text-2xl text-black">StorySpotlight</h1>
<div class="row">
    <div class="grid gap-4 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-4 shadow-black">
        @foreach ($stories as $story)
        <div class="p-4 bg-white shadow-md rounded-lg">
            <h3 class="text-lg font-bold text-indigo-600">{{ $story->title }}</h3>
            <p class="text-gray-600 mt-2">{{ Str::limit($story->content, 100) }}</p>
            @if($story->image_url)
            <img src="{{ $story->image_url }}" alt="{{ $story->title }}" class="w-full h-auto mt-4">
            @endif
            <div class="text-sm text-gray-500 mt-3">
            {{-- <span>By {{ $story->author->name }}</span> •  --}}
            <span>{{ \Carbon\Carbon::parse($story->published_date)->diffForHumans() }}</span>

             </div>
             <a href="{{ route('stories.show', $story->slug) }}" class="btn btn-primary">Read More</a>

        </div>
         @endforeach
    </div>
</div>
<hr/>
 <h1 class="text-2xl font-bold text-blue-800 text-center animate-bounce">View our products</h1>
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mt-4">
    @foreach($products as $product)
        <div class="p-4 bg-white shadow-md rounded-lg">
            <a href="{{ route('shops.show', $product->id) }}" class="block">
                <h3 class="text-lg font-bold text-indigo-600">{{ $product->name }}</h3>
                <p class="text-gray-600 mt-2">{{ Str::limit($product->description, 100) }}</p>
                @if($product->image_url)
                <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full h-auto mt-4">
                @endif
            </a>
        </div>
    @endforeach
</div>
 </div>
<hr/>
<h1 class="text-2xl font-bold text-center text-red-800">Exclusive Ebooks</h1>
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mt-4">
    @foreach($ebooks as $ebook)
        <div class="p-4 bg-white shadow-md rounded-lg">
                 <h3 class="text-lg font-bold text-indigo-600">{{ $ebook->title }}</h3>
                <p class="text-gray-600 mt-2">{{ Str::limit($ebook->description, 100) }}</p>
                @if($ebook->cover_image_url)
                <img src="{{ $ebook->cover_image_url }}" alt="{{ $ebook->title }}" class="w-full h-auto mt-4">
                @endif
            </a>
            <div class="text-sm text-gray-500 mt-3">
                <span>{{ \Carbon\Carbon::parse($ebook->published_date)->diffForHumans() }}</span>
            </div>
            <a href="{{ route('ebooks.show', $ebook->id) }}" class="btn btn-primary">Read More</a>

        </div>
    @endforeach
</div><hr/>

 
 @endsection
