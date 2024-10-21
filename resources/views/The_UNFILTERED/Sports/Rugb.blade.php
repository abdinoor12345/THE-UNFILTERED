   
@extends('layouts.website')

@section('title', 'Sports,soccer,football')

@section('meta')
    <meta name="description" content="Stay updated with the latest news from The Unfiltered, Global News Agency. We provide unbiased and comprehensive news coverage.">
    <meta name="keywords" content="news, global news, unfiltered news, latest news, current events, T">
@endsection

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-16 border-l-2 border-red-400">
    <main class="container mx-auto bg-transparent mt-8">
        
        @if ($latest)
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
            <!-- First post covering half the page -->
            <div class="col-span-1 lg:col-span-2">
                <article class="mb-8 p-6 rounded-lg bg-green-300 shadow-lg">
                    <a href="{{ route('basket.show', $latest->slug) }}">
                        <h1 class="text-3xl font-bold text-white mb-4">{{ $latest->title }}</h1>
                        <div class="flex flex-row gap-4">
                            <p class="text-gray-900 text-lg flex-1">{{ $latest->description }}</p>
                             
                        </div>
                    </a>
                </article>
            </div>

            <!-- Remaining posts filling the rest -->
            @foreach($news as $item)
            <article class="    p-4">
                <a href="{{ route('basket.show', $item->slug) }}">
                    <h2 class="text-xl font-bold text-blue-700">{{ $item->title }}</h2>
                    <p class="text-gray-700 mt-2">{{ $item->description }}</p>
                    @if($item->image_url)
                    <img src="{{ $item->image_url }}" alt="{{ $item->title }}" class="w-full h-auto mt-4 rounded-lg">
                    @endif
                </a>
            </article>
            @endforeach
        </div>
        
          
        @else
        <h1 class="text-lg text-white text-center font-bold bg-red-300">No Updates</h1>
        @endif
    </main>
</div>
@endsection

