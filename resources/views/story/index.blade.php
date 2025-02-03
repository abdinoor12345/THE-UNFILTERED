@extends('layouts.website')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1 class="text-2xl font-bold text-gray-800 mb-6 text-center text-primary mt-8">Stories</h1>
            <p class="text-center mb-4 font-extrabold">We believe in the power of storytelling. Share your unique experiences and insights with our community, and let your story reach and inspire others. Together, we can create a tapestry of diverse voices and perspectives.</p>
            <p class="text-center"><a href="/contact" class="text-blue-500 underline font-bold">Contact Us</a></p>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach($stories as $story)
                <div class="bg-white shadow-md rounded-lg p-6">
                    <img src="{{ $story->image_url }}" alt="{{ $story->title }}" class="w-full h-32 object-cover object-center mb-4">
                    <h2 class="text-xl font-bold text-gray-800 mb-4">{{ $story->title }}</h2>
                    <p class="text-gray-600">{{ $story->description }}</p>
                    <a href="{{ route('stories.show', $story->slug) }}" class="text-blue-600 hover:underline font-bold">Read More</a>
                     

                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

@endsection