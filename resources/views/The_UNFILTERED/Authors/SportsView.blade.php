@extends('layouts.website')

@section('title', 'THE UNFILTERED, GLOBAL NEWS AGENCY')

@section('meta')
    <meta name="description" content="Stay updated with the latest news from The Unfiltered, Global News Agency. We provide unbiased and comprehensive news coverage.">
    <meta name="keywords" content="news, global news, unfiltered news, latest news, current events">
@endsection

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-16">
 
         
        <main class="container mx-auto bg-transparent mt-8">
            <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-4">
                @foreach($sport as $item)
                    <article class="mb-4 rounded-lg ">
                        <a href="{{ route('sports.show', $item->slug) }}" class="block p-4 mt-4"> <header>
                            <h2 class="text-xl font-bold text-blue-700">{{ $item->title }}</h2>
                            <p class=" text-gray-900 text-xl font-bold">{{ $item->description }}</p></header>
                            @if($item->important_link)
                                <a href="{{ $item->important_link }}" target="_blank" class="text-blue-600 hover:underline mt-2 block">
                                    Read More
                                </a>
                            @endif
                            @if($item->image_url)
                            <img src="{{ $item->image_url }}" alt="{{ $item->title }}" class="w-full h-auto mt-2 rounded">
                        @endif
                                                </a><span class="d-flex">
                                                <p class="text-lg font-bold text-blue-900"><a href="{{route('sports.edit',$item->id)}}">Edit</a></p>
                                                
                                                {{-- <p class="text-lg font-bold text-red-900"><a href="{{route('delete.top_stories_news',$item->id)}}">delete</a></p> --}}
</span>
                    </article>
                @endforeach
            </div>
        </main>
    </div>
@endsection
