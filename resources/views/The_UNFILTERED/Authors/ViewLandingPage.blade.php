@extends('layouts.admin')

@section('title', 'THE UNFILTERED, GLOBAL NEWS AGENCY')

@section('meta')
    <meta name="description" content="Stay updated with the latest news from The Unfiltered, Global News Agency. We provide unbiased and comprehensive news coverage.">
    <meta name="keywords" content="news, global news, unfiltered news, latest news, current events">
@endsection

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-16">
        
         
        <main class="container mx-auto bg-transparent mt-8">
            <div class="flex flex-row gap-2 overflow-x-scroll bg-green-200 text-lg font-bold">
                <p><a href="/TopStoriesPage" class="no-underline ml-2">TopStories</a></p>
                <p><a href="/OpinionPage" class="no-underline ml-2">Politics</a></p>
                <p><a href="/BusinessPage" class="no-underline ml-2">Business</a></p>
                <p><a href="/TechnologyPage" class="no-underline ml-2">Technology</a></p>
                <p><a href="/viewlandingpage" class="no-underline ml-2">Videos</a></p>
                <p><a href="/viewlandingpage" class="no-underline ml-2">Sports</a></p>
                <p><a href="/LinkPage" class="no-underline ml-2">Links</a></p>



            </div>
            <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-4">
                @foreach($news as $item)
                    <article class="mb-4 rounded-lg ">
                        <a href="{{ route('news.show', $item->slug) }}" class="block p-4 mt-4"> <header>
                            <h2 class="text-xl font-bold text-blue-700">{{ $item->title }}</h2>
                            <p class=" text-gray-900 text-xl font-bold">{{ $item->description }}</p></header>
                           
                            @if($item->image_url)
                            <img src="{{ $item->image_url }}" alt="{{ $item->title }}" class="w-full h-auto mt-2 rounded">
                        @endif
                                                </a><span class="flex flex-row gap-2"> <p class="text-lg font-bold text-blue-900"><a href="{{route('news.edit',$item->id)}}">Edit</a></p>
                                                    {{-- <p class="text-lg font-bold text-red-900"><a href="{{route('delete.news',$item->id)}}">delete</a></p> --}}
    </span>
                                                
                    </article>
                @endforeach
            </div>
        </main>
    </div>
@endsection
