@extends('layouts.website')

@section('title', 'THE UNFILTERED,Opinions,Trending')

@section('meta')
    <meta name="description" content="Stay updated with the latest news from The Unfiltered, Global News Agency. We provide unbiased and comprehensive news coverage.">
    <meta name="keywords" content="news, global news, unfiltered news, latest news, current events,Trending,opinions">
@endsection

@section('content')
    <div class="  mx-auto px-4 sm:px-6 lg:px-8 mt-16 font-serif">@if ($latest)
        
         <h1 class="text-lg text-white text-center font-bold bg-green-300"><a href="{{ route('opinions.show', $latest->slug) }}" class="text-blue-600 hover:underline">
            {{$latest->title}}</a> </h1>         
 @else<h1 class="text-lg text-white text-center font-bold bg-red-300">No Updates</h1>@endif
         
        <main class="container mx-auto bg-transparent mt-8">
            <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-3">
                @foreach($news as $item)
                    <article class="mb-4 rounded-lg shadow-md ">
                        <a href="{{ route('opinions.show', $item->slug) }}" class="block p-4 mt-4">
                            <header>
                            <h2 class="text-xl font-bold text-blue-700">{{ $item->title }}</h2>
                            <div class="flex flex-grow gap-4 item-center">    
                                <p class="text-gray-500 text-sm">   Posted:{{ $item->created_at->diffForHumans() }}</p>
                                    @if($item->user)
                   <span class="text-gray-400 text-sm font-bold"> Posted by: {{$item->user->name}}</span>@else
                   Posted by: <span class="text-gray-200 text-sm font-bold">Anonymous</span>
                    @endif</div>
                            <p class=" text-gray-900 text-xl font-bold">{{ $item->description }}</p></header>
                            
                             @if($item->image_url)
                            <img src="{{ $item->image_url }}" alt="{{ $item->title }}" class="w-full h-auto mt-2 rounded">
                        @endif
                                                </a>
                     </article>
                @endforeach
            </div>
        </main>
        <aside class="container mx-auto mt-12">
            <h2 class="text-2xl font-bold text-purple-800 text-center font-serif">Popular Posts</h2>
            <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-3">
                @foreach($popularPosts as $popular)
                    <article class="mb-4 p-4 bg-gray-100 rounded-lg">
                        <a href="{{ route( 'opinions.show', $popular->slug) }}" class="block">
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
        </aside>
    </div>
@endsection
