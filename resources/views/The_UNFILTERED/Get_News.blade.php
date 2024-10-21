@extends('layouts.website')

@section('title', 'THE UNFILTERED, GLOBAL NEWS AGENCY')

@section('content')
<div class="container mx-auto bg-transparent">
    <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-4">
        @foreach($news as $item)
        <div class="mb-4">
            <h2 class="text-xl font-bold text-center">{{ $item->title }}</h2>
            <p class="text-center font-bold text-lg">{{ $item->description }}</p>
            
            <!-- Display the image if the URL exists -->
            @if($item->image_url)
                <img src="{{ $item->image_url }}" alt="{{ $item->title }}" class="w-full h-auto mb-2">
            @endif
    
            <!-- Render the content -->
            <p>
                {!! str_replace('{link1}', '<a href="' . $item->link1 . '" target="_blank" class="text-blue-600 hover:underline">' . $item->link_text1 . '</a>', $item->content) !!}
            </p>
            
            <!-- Optionally include other links after the content -->
            @if($item->link2 && $item->link_text2)
                <a href="{{ $item->link2 }}" target="_blank" class="text-blue-600 hover:underline mb-1">
                    {{ $item->link_text2 }}
                </a>
            @endif

            @if($item->link3 && $item->link_text3)
                <a href="{{ $item->link3 }}" target="_blank" class="text-blue-600 hover:underline mb-1">
                    {{ $item->link_text3 }}
                </a>
            @endif
        </div>
        @endforeach
    </div>
</div>
@endsection
