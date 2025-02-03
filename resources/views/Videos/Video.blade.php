@extends('layouts.website')

@section('title', $pageTitle ?? 'Videos, Interviews, News, Highlights')

@section('meta')
    <meta name="description" content="{{ $metaDescription ?? 'Stay updated with the latest news from The Unfiltered, Global News Agency. We provide unbiased and comprehensive news coverage.' }}">
    <meta name="keywords" content="{{ $metaKeywords ?? 'news, global news, unfiltered news, videos, interviews, highlights, latest news, current events' }}">
@endsection

@section('content')
<div class="mx-auto px-4 sm:px-6 lg:px-8 mt-16 bg-slate-100 border-l-8 border-sky-500">
    <main class="mx-auto mt-8">
        <div class="">
            
            <h1 class=" underline text-2xl text-pink-700 font-bold mt-10 font-serif">
                {{ $headerText ?? 'Stay informed with our latest video reports, covering breaking news, in-depth analysis, and exclusive interviews from around the globe.' }}
            </h1>
             
            <!-- Dynamic Video Embeds -->
            <div class="mt-6 grid grid-cols-1  md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($video as $video)
                    <div class="mb-8">
                        <h2 class="text-lg font-bold text-blue-900">{{ $video['title'] }}</h2>
                        <p class="text-sm font-bold text-black">{{ $video['description'] }}</p>
                        <div class="aspect-w-16 aspect-h-9 mt-4">
                            <video id="player" playsinline>
                                <source src="{{ $video['url'] }}" type="video/mp4" />
                            </video>
                        </div>
                        
                    </div>
                @endforeach
            </div>
        </div>
    </main>
</div>
@endsection
