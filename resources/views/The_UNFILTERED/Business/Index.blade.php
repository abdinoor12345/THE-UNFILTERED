@extends('layouts.website')

@section('title', 'THE UNFILTERED,business,money,Trending')

@section('meta')
    <meta name="description" content="Stay updated with the latest news from The Unfiltered, Global News Agency. We provide unbiased and comprehensive news coverage.">
    <meta name="keywords" content="news, global news, unfiltered news, latest news, current events,Trending,business,money">
@endsection

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6  bg-water lg:px-8 mt-16 border-l-4 border-red-800">@if ($latest)
        @if (Session::has('success'))
        <div class="text-center text-green-800 text-lg mt-2">{{ Session::get('success') }}</div>
    @endif
         <h1 class="text-lg text-white text-center font-bold bg-green-300"><a href="{{ route('business.show', $latest->slug) }}" class="text-blue-600 hover:underline">
            {{$latest->title}}</a> </h1>         
 @else<h1 class="text-lg text-white text-center font-bold bg-red-300">No Updates</h1>@endif
         
        <main class="container mx-auto   mt-8">
            <div class="grid grid-cols-1 gap-4 md:grid-cols-1 lg:grid-cols-2">
                @foreach($news as $item)
                    <article class="mb-4 rounded-lg shadow-md bg-lime-100 ">
                        <a href="{{ route('business.show', $item->slug) }}" class="block p-4 mt-4">
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
                                                <div class="flex flex-grow gap-4 item-center border-l-2 border-red-700">    
                                                    <p class="text-gray-500 text-sm">   Posted:{{ $item->created_at->diffForHumans() }}</p>
                                                        @if($item->user)
                                       <span class="  text-green-300 text-sm font-bold"> Posted by: {{$item->user->name}}</span>@else
                                       Posted by: <span class="text-gray-200 text-sm font-bold">Anonymous</span>
                                        @endif</div>
                     </article>
                @endforeach
            </div>
        </main>
        <aside class="container mx-auto mt-12">
            <h2 class="text-2xl font-bold text-purple-800 text-center font-serif">Popular Posts</h2>
            <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-3">
                @foreach($popularPosts as $popular)
                    <article class="mb-4 p-4 bg-gray-100 rounded-lg">
                        <a href="{{ route( 'business.show', $popular->slug) }}" class="block">
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
