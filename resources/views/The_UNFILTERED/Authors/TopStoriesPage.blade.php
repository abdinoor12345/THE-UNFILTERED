@extends('layouts.website')

@section('title', 'THE UNFILTERED, GLOBAL NEWS AGENCY')

@section('meta')
    <meta name="description" content="Stay updated with the latest news from The Unfiltered, Global News Agency. We provide unbiased and comprehensive news coverage.">
    <meta name="keywords" content="news, global news, unfiltered news, latest news, current events">
@endsection

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-16 border-l-8 border-yellow-600">
 
         
        <main class="container mx-auto bg-transparent mt-8">@role('super-admin')
            <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-4">
                @foreach($Top_Story as $item)
                    <article class="mb-4 rounded-lg ">
                        <a href="{{ route('top_stories.show', $item->slug) }}" class="block p-4 mt-4"> <header>
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
                                                </a><span class="flex flex-grow gap-2">
                                                <p class="text-lg font-bold text-blue-900 bg-slate-300 rounded p-2"><a href="{{route('top_stories.edit',$item->id)}}">Edit</a></p>
                                                <form action="{{route('delete.top_stories_news',$item->id)}}" method="get" onsubmit="return confirmDelete();">
                                                    @method('DELETE')
                                                    <button type="submit" class="bg-red-500 rounded p-2 ">Delete</button>
                                                </form>
 </span>
                    </article>
                @endforeach
            </div>
      @endrole  </main>
    </div>
    <script>
        function confirmDelete(){
            return confirm('Are sure You Want to delete this');
        }
    </script>
@endsection
