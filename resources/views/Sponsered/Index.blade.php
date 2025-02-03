@extends('layouts.website')

@section('content')
<div class="container mx-auto py-9">
 
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <h1 class="my-4 text-center text-black font-bold  text-2xl mt-24">Sponsored Posts</h1><hr/>

    <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-5 gap-4 mt-4">
        @if(count($sponsereds) > 0)
            @foreach($sponsereds as $sponsered)
                <div class="bg-white shadow-md rounded-lg overflow-hidden">
                    @if($sponsered->image_url)
                        <img src="{{ $sponsered->image_url }}" class="w-full h-48 object-cover" alt="Image for {{ $sponsered->title }}">
                    @else
                        <a href="/">
                            <img src="{{ asset('Images/THE UNFILTERED.png') }}" alt="The Unfiltered Logo" class="w-full object-cover h-auto mr-4">
                        </a>
                    @endif
                    <div class="p-4">
                        <h5 class="text-lg font-bold">{{ $sponsered->title }}</h5>
                        <p class="text-gray-700">{{ Str::limit($sponsered->description, 100) }}</p>
                        <div class="mt-4 flex justify-between items-center">
                            <a href="{{ route('sponsereds.show', $sponsered->slug) }}" class="bg-blue-500 text-white px-3 py-1 rounded">View</a>
                            {{-- <a href="{{ route('sponsereds.edit', $sponsered->id) }}" class="bg-gray-500 text-white px-3 py-1 rounded">Edit</a> --}}
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <p class="col-span-3 text-center">No sponsored posts found.</p>
        @endif
    </div>
</div>
@endsection
