@extends('layouts.admin')

@section('title', 'THE UNFILTERED, GLOBAL NEWS AGENCY')

 
@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-16">
        <h1 class="text-lg text-white text-center font-bold bg-green-300">Latest update from unfiltered</h1>         

         
        <main class="container mx-auto bg-transparent mt-8">
            <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-4">
                @foreach($opinion as $item)
                    <article class="mb-4 rounded-lg ">
                        <a href="{{ route('news.show', $item->slug) }}" class="block p-4 mt-4"> <header>
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
                                                </a><span class="flex flex-row gap-2"> <p class="text-lg font-bold text-blue-900"><a href="{{route('opinions.edit',$item->id)}}">Edit</a></p>
      <form action="{{ route('delete.opinions',$item->id) }}" method="get" onsubmit="return confirmDelete();">
        @csrf
        @method('DELETE')
        <button type="submit" class="bg-red-600 p-2 ring-1 rounded-lg">Delete</button>
    </form></span>
                                                
                    </article>
                @endforeach
            </div>
        </main>
    </div>
    <script>
        function confirmDelete() {
            return confirm('Are you sure you want to delete this news story?');
        }
    </script>
@endsection
