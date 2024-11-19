@extends('layouts.website')

@section('title', 'THE UNFILTERED, Business, Money, Trending')

@section('meta')
    <meta name="description" content="Stay updated with the latest news from The Unfiltered, Global News Agency. We provide unbiased and comprehensive news coverage.">
    <meta name="keywords" content="news, global news, unfiltered news, latest news, current events, Trending, business, money">
@endsection

@section('content')
    <div class="bg-gray-100 mx-auto px-6 sm:px-8 lg:px-12 py-8 mt-16 rounded-lg shadow-lg">
        @if (Session::has('success'))
            <div class="text-center text-green-800 text-lg mt-2 font-semibold">{{ Session::get('success') }}</div>
        @endif
        
        @if ($latest)
            <h1 class="text-2xl text-center font-bold bg-green-300 text-gray-800 py-3 rounded-md shadow">
                <a href="{{ route('business.show', $latest->slug) }}" class="hover:underline">{{ $latest->title }}</a>
            </h1>
        @else
            <h1 class="text-lg text-center font-bold bg-red-300 text-gray-800 py-3 rounded-md">No Updates</h1>
        @endif

        <main class="container mx-auto mt-10">
            <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
                @foreach($news as $item)
                    <article class="bg-white rounded-lg shadow-lg p-6 hover:shadow-xl transition duration-200 ease-in-out">
                        <a href="{{ route('business.show', $item->slug) }}" class="block">
                            <header>
                                <h2 class="text-xl font-semibold text-blue-800">{{ $item->title }}</h2>
                                <div class="flex items-center gap-2 mt-1 text-gray-500 text-sm">
                                    <p>Posted: {{ $item->created_at->diffForHumans() }}</p>
                                    <span class="font-bold">| Posted by: {{ $item->user ? $item->user->name : 'Anonymous' }}</span>
                                </div>
                                <p class="text-gray-700 mt-3">{{ $item->description }}</p>
                            </header>
                            @if($item->image_url)
                                <img src="{{ $item->image_url }}" alt="{{ $item->title }}" class="w-full h-40 object-cover mt-4 rounded-md">
                            @endif
                        </a>
                    </article>
                @endforeach
            </div>
        </main>

        <div class="social-btn-sp text-center py-6">
            <h2 class="text-lg font-bold text-gray-800">Share Our Content</h2>
            <div class="flex justify-center space-x-8 text-blue-600 mt-3">
                {!! $shareButtons !!}
            </div>
        </div>

        <aside class="container mx-auto mt-12">
            <h2 class="text-2xl font-bold text-purple-800 text-center mb-8">Popular Posts</h2>
            <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
                @foreach($popularPosts as $popular)
                    <article class="bg-gray-50 rounded-lg shadow p-6 hover:shadow-lg transition duration-200 ease-in-out">
                        <a href="{{ route('business.show', $popular->slug) }}" class="block">
                            <h3 class="text-lg font-semibold text-blue-700">{{ $popular->title }}</h3>
                            <p class="text-gray-600 mt-3">{{ Str::limit($popular->description, 100) }}</p>
                            @if($popular->image_url)
                                <img src="{{ $popular->image_url }}" alt="{{ $popular->title }}" class="w-full h-40 object-cover mt-4 rounded-md">
                            @endif
                        </a>
                        <div class="text-sm text-gray-500 mt-2">
                            <span>{{ $popular->created_at->diffForHumans() }}</span> • <span>{{ $popular->views }} views</span>
                        </div>
                    </article>
                @endforeach
            </div>
        </aside>
    </div>
@endsection
