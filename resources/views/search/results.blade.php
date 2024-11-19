 <!-- resources/views/search/results.blade.php -->

@extends('layouts.website')

@section('header')
    <h2>Search Results for "{{ $query }}"</h2>
@endsection

@section('content')
<style>body {
    overflow-x: hidden;
}</style>

<div class="p-6">
    @if($sports->isEmpty() && $politics->isEmpty() && $trendings->isEmpty() && $technologies->isEmpty() && $businesses->isEmpty() && $topStories->isEmpty())
        <p>No results found.</p>
    @else
        <!-- Sports Section -->
        @if(!$sports->isEmpty())
            <h3 class="text-center text-red-500 text-xl font-bold">Sports</h3>
            <ul>
                @foreach ($sports as $sport)
                    <li class="text-center text-primary text-xl">{{ $sport->title }}</li>
                    <li class="text-center text-black text-xl">{{ $sport->description }}</li>
                    @if ($sport->image_url)
                        <img src="{{ $sport->image_url }}" alt="{{ $sport->title }}" class="w-full object-cover rounded" />
                    @endif  
                    <p class="mt-4 text-lg font-bold ml-0 whitespace-pre-line">
                        {!! \App\Helpers\replaceWordsWithLinks($sport->content, $links) !!}
                    </p> 
                @endforeach
            </ul>
        @endif

        <!-- Politics Section -->
        @if(!$politics->isEmpty())
            <h3 class="text-center text-red-500 text-xl font-bold">Politics</h3>
            <ul>
                @foreach ($politics as $politic)
                    <li class="text-center text-primary text-xl">{{ $politic->title }}</li>
                    <li class="text-center text-black text-xl">{{ $politic->description }}</li>
                    @if ($politic->image_url)
                        <img src="{{ $politic->image_url }}" alt="{{ $politic->title }}" class="w-full object-cover rounded" />
                    @endif  
                    <p class="mt-4 text-lg font-bold ml-0 whitespace-pre-line">
                        {!! \App\Helpers\replaceWordsWithLinks($politic->content, $links) !!}
                    </p> 
                @endforeach
            </ul>
        @endif

        <!-- Trendings Section -->
        @if(!$trendings->isEmpty())
            <h3 class="text-center text-red-500 text-xl font-bold">Trendings</h3>
            <ul>
                @foreach ($trendings as $trending)
                    <li class="text-center text-primary text-xl">{{ $trending->title }}</li>
                    <li class="text-center text-black text-xl">{{ $trending->description }}</li>
                    @if ($trending->image_url)
                        <img src="{{ $trending->image_url }}" alt="{{ $trending->title }}" class="w-full object-cover rounded" />
                    @endif  
                    <p class="mt-4 text-lg font-bold ml-0 whitespace-pre-line">
                        {!! \App\Helpers\replaceWordsWithLinks($trending->content, $links) !!}
                    </p> 
                @endforeach
            </ul>
        @endif

        <!-- Technologies Section -->
        @if(!$technologies->isEmpty())
            <h3 class="text-center text-red-500 text-xl font-bold">Technologies</h3>
            <ul>
                @foreach ($technologies as $technology)
                    <li class="text-center text-primary text-xl">{{ $technology->title }}</li>
                    <li class="text-center text-black text-xl">{{ $technology->description }}</li>
                    @if ($technology->image_url)
                        <img src="{{ $technology->image_url }}" alt="{{ $technology->title }}" class="w-full object-cover rounded" />
                    @endif  
                    <p class="mt-4 text-lg font-bold ml-0 whitespace-pre-line">
                        {!! \App\Helpers\replaceWordsWithLinks($technology->content, $links) !!}
                    </p> 
                @endforeach
            </ul>
        @endif

        <!-- Businesses Section -->
        @if(!$businesses->isEmpty())
            <h3 class="text-center text-red-500 text-xl font-bold">Businesses</h3>
            <ul>
                @foreach ($businesses as $business)
                    <li class="text-center text-primary text-xl">{{ $business->title }}</li>
                    <li class="text-center text-black text-xl">{{ $business->description }}</li>
                    @if ($business->image_url)
                        <img src="{{ $business->image_url }}" alt="{{ $business->title }}" class="w-full object-cover rounded" />
                    @endif  
                    <p class="mt-4 text-lg font-bold ml-0 whitespace-pre-line">
                        {!! \App\Helpers\replaceWordsWithLinks($business->content, $links) !!}
                    </p> 
                @endforeach
            </ul>
        @endif

        <!-- Top Stories Section -->
        @if(!$topStories->isEmpty())
            <h3 class="text-center text-red-500 text-xl font-bold">Top Stories</h3>
            <ul>
                @foreach ($topStories as $topStory)
                    <li class="text-center text-primary text-xl">{{ $topStory->title }}</li>
                    <li class="text-center text-black text-xl">{{ $topStory->description }}</li>
                    @if ($topStory->image_url)
                        <img src="{{ $topStory->image_url }}" alt="{{ $topStory->title }}" class="w-full object-cover rounded" />
                    @endif  
                    <p class="mt-4 text-lg font-bold ml-0 whitespace-pre-line">
                        {!! \App\Helpers\replaceWordsWithLinks($topStory->content, $links) !!}
                    </p> 
                @endforeach
            </ul>
        @endif
    @endif
</div>
@endsection
