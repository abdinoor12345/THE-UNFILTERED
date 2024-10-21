@extends('layouts.website')

@section('title', $pageTitle ?? 'Videos, Interviews, News, Highlights')

@section('meta')
    <meta name="description" content="{{ $metaDescription ?? 'Stay updated with the latest news from The Unfiltered, Global News Agency. We provide unbiased and comprehensive news coverage.' }}">
    <meta name="keywords" content="{{ $metaKeywords ?? 'news, global news, unfiltered news, videos, interviews, highlights, latest news, current events' }}">
@endsection

@section('content')
<div class="mx-auto px-4 sm:px-6 lg:px-8 mt-16 bg-slate-900 border-l-8 border-sky-500">
    <main class="mx-auto mt-8">
        <div class="">
            <h1 class="font-mono underline text-2xl text-pink-700 font-bold mb-4">
                {{ $headerText ?? 'Stay informed with our latest video reports, covering breaking news, in-depth analysis, and exclusive interviews from around the globe.' }}
            </h1>

            <!-- Dynamic Video Embeds -->
            <div class="mt-6 grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-3">
                @foreach($videos as $video)
                    <div class="mb-8">
                        <h2 class="text-lg font-bold text-white">{{ $video['title'] }}</h2>
                        <div class="aspect-w-16 aspect-h-9">
                            <iframe class="w-full h-full" src="{{ $video['url'] }}" title="{{ $video['title'] }}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </main>
</div>
@endsection
