@extends('layouts.website')

@section('title', 'Videos, Interviews, News, Highlights')

@section('meta')
    <meta name="description" content="Stay updated with the latest news from The Unfiltered, Global News Agency. We provide unbiased and comprehensive news coverage.">
    <meta name="keywords" content="news, global news, unfiltered news, videos, interviews, highlights, latest news, current events">
@endsection

@section('content')
<div class="mx-auto px-4 sm:px-6 lg:px-8 mt-16 bg-black border-l-8 border-sky-500">
    <h1 class="text-center text-red-700 text-2xl font-mono animate-pulse">🎙️ Interviews</h1>
    <p class="text-xl font-sans text-white  ">Exclusive conversations with key figures in politics, business, sports, and entertainment. Hear firsthand accounts,
         insights, and opinions from the people making news.</p>

    <main class="mx-auto mt-8">
        <!-- Video Section -->
        <div class="mt-6 grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3">
            @foreach($videoData as $video)
            <div class="mb-8">
                <h2 class="text-lg font-bold text-zinc-50">{{ $video['title'] }}</h2>
                <div class="aspect-w-16 aspect-h-9">
                    <iframe class="w-full h-full" src="https://www.youtube.com/embed/{{ $video['youtube_id'] }}" title="{{ $video['title'] }}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>
            </div>
            @endforeach
        </div>
    </main>
</div>
@endsection
