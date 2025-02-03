@extends('layouts.website')

@section('title', 'The Unfiltered - Latest Sports News: Football, Basketball, Hockey, UEFA, EPL')

@section('meta')
    <meta name="description" content="Stay updated with the latest sports news from The Unfiltered. We provide unbiased and comprehensive coverage on football, basketball, hockey, UEFA, EPL, La Liga, Bundesliga, and more.">
    <meta name="keywords" content="sports news, football, basketball, hockey, UEFA, EPL, La Liga, Bundesliga, global sports news, trending sports, latest updates">
@endsection

@section('content')
    <div class="max-w-9xl mx-auto px-4 sm:px-6 lg:px-8 mt-16 border-l-2 border-red-400">
        @if ($latest)
            <h1 class="text-3xl font-bold text-blue-800 text-center">⚽ Sports Around The World</h1>
            <div class="flex flex-grow shadow-md gap-8 justify-center mt-4">
                <a href="/soccer" target="_blank" class="flex items-center">
                    <span class="mr-2">⚽</span>
                    <h1 class="text-sm font-bold">Soccer</h1>
                </a>
                <a href="/cricket" class="flex items-center">
                    <span class="mr-1">🏏</span>
                    <h1 class="text-sm font-bold">Cricket</h1>
                </a>
                <a href="/hockey" target="_blank" rel="noopener noreferrer" class="flex items-center">
                    <span class="mr-2">🏒</span>
                    <h1 class="text-sm  font-bold">Hockey</h1>
                </a>
                <a href="/basketball" class="flex items-center">
                    <span class="mr-2">🏀</span>
                    <h1 class="text-sm font-bold">Basketball</h1>
                </a>
            </div>
<a  class="text-center font-bold text-pink-500 animate-pulse" href="https://www.koora-live.vip/">Live Updates</a>
            <h1 class="text-lg text-white text-center font-bold mt-4 bg-green-300">
                <a href="{{ route('sports.show', $latest->slug) }}" class="text-blue-600 hover:underline">
                    {{ $latest->title }}
                </a>
            </h1>
        @else
            <h1 class="text-lg text-white text-center font-bold bg-red-300">No Updates</h1>
        @endif

        <main class="container mx-auto bg-transparent mt-8">
            <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-3">
                @foreach($news as $item)
                    <article class="mb-4 rounded-lg shadow-md">
                        <a href="{{ route('sports.show', $item->slug) }}" class="block p-4 mt-4">
                            <header>
                                <h2 class="text-xl font-bold text-blue-700 font-mono">{{ $item->title }}</h2>
                                <div class="flex flex-grow gap-4 items-center">
                                    <p class="text-green-500 text-sm">Posted: {{ $item->created_at->diffForHumans() }}</p>
                                    @if($item->user)
                                        <span class="text-green-400 text-sm font-bold">Posted by: {{ $item->user->name }}</span>
                                    @else
                                        <span class="text-red-200 text-sm font-bold">Posted by: Anonymous</span>
                                    @endif
                                </div>
                                <p class="text-gray-900 text-xl font-bold">{{ $item->description }}</p>
                            </header>
                            
                            @if($item->image_url)
                                <img src="{{ $item->image_url }}" alt="{{ $item->title }}" class="w-full h-auto mt-2 rounded">
                            @endif
                        </a>
                    </article>
                @endforeach
            </div>
<hr/>
<div class="social-btn-sp text-center py-4">
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
                <a href="{{ route( 'sports.show', $popular->slug) }}" class="block">
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
</aside><h1 class="text-lg text-primary text-center font-serif">Europe Leagues</h1>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4     gap-4 justify-between mt-8">
                <div class=" ml-2 block shadow-md rounded-lg bg-cyan-500">
                    <a href="https://www.premierleague.com/" target="_blank" rel="noopener noreferrer">
                        <h1 class="text-lg font-bold text-red-600">⚽ EPL Matches, Live Scores, Table</h1>
                        <img src="https://res.cloudinary.com/dd2shhmgr/image/upload/v1728238778/epl_ac9qdk.jpg" alt="EPL" class="w-full h-32 object-cover rounded-lg mt-2">
                    </a>
                </div>
                
                <div class="block shadow-md rounded-lg bg-cyan-500">
                    <a href="https://res.cloudinary.com/dd2shhmgr/image/upload/v1728238794/laliga_zogprb.jpg" target="_blank" rel="noopener noreferrer">
                        <h1 class="text-lg font-bold text-red-600">⚽ La Liga Matches, Live Scores, Table</h1>
                        <img src="https://res.cloudinary.com/dd2shhmgr/image/upload/v1728238794/laliga_zogprb.jpg" alt="La Liga" class="w-full h-32 object-cover rounded-lg mt-2">
                    </a>
                </div>
                
                <div class="block shadow-md rounded-lg bg-cyan-500">
                    <a href="https://www.bundesliga.com/en/bundesliga" target="_blank" rel="noopener noreferrer">
                        <h1 class="text-lg font-bold text-red-600">⚽ Bundesliga Matches, Live Scores, Table</h1>
                        <img src="https://res.cloudinary.com/dd2shhmgr/image/upload/v1728238765/bunde_yb4h0d.png" alt="Bundesliga" class="w-full h-32 object-cover rounded-lg mt-2">
                    </a>
                </div>
                
                <div class="block shadow-md rounded-lg bg-cyan-500">
                    <a href="https://www.uefa.com/uefachampionsleague/" target="_blank" rel="noopener noreferrer">
                        <h1 class="text-lg font-bold text-red-600">⚽ UEFA Champions League</h1>
                        <img src="https://res.cloudinary.com/dd2shhmgr/image/upload/v1728238808/uefa_nj3pf9.png" alt="UEFA" class="w-full h-32 object-cover rounded-lg mt-2">
                    </a>
                </div>
                
            </div>
        </main>
    </div>

    
@endsection
