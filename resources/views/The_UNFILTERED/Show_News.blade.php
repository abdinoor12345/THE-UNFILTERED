@extends('layouts.website')

@section('title', $post->title)

@section('meta')
    <meta name="description" content="{{ $post->description }}">
@endsection
<style>.p{
    font-family: "Times New Roman";
    
  }
  .h1{  font-family: Arial, Helvetica, sans-serif;
  }
  .h3 {
  font-family: "Lucida Console", "Courier New", monospace;
}</style>
@section('content')
<div class="max-w-9xl mx-auto px-4 sm:px-6 lg:px-8 mt-16  ">
    <!-- Post Content -->
    <h1 class="text-2xl font-bold text-blue-800 text-center underline mb-2">{{ $post->title }}</h1>
    <p class="text-gray-700 text-sm font-bold text-center">{{ $post->description }}</p>
    <span class="text-center text-black font-bold lg:mx-6">{{ $post->views }} views</span>
    @if ($post->user)
        <span class="text-center text-primary font-bold lg:mx-8">   
            By {!! \App\Helpers\replaceWordsWithLinks($post->user->name, $links) !!}
        </span>
    @else
        <span class="text-center text-gray-500">Anonymous</span>
    @endif
    <span class="text-black">{{ $post->created_at->diffForHumans() }}</span> • 
    <div class="social-btn-sp text-center py-4">
        <h1 class="text-blue-700 text-center text-lg mb-4 font-bold">Share Our Contents</h1>
        <div class="flex justify-left space-x-2 text-red-600">
            {!! $shareButtons !!}
        </div>
    </div>
    @if($post->image_url)
        <img src="{{ $post->image_url }}" alt="{{ $post->title }}" class="w-full h-auto mt-4">
    @endif

    <!-- Content display logic -->
    <p class="mt-4 text-lg font-medium ml-0 whitespace-pre-line tracking-wider space-x-4 rounded-lg shadow-xl p-6">
        @if(auth()->check())
             {!! \App\Helpers\replaceWordsWithLinks($post->content, $links) !!}
        @else
             {!! \Illuminate\Support\Str::limit(\App\Helpers\replaceWordsWithLinks($post->content, $links), 1000) !!}
            <br>
            <a href="{{ route('login') }}" class="text-blue-500 font-mono">Log in to read more...</a>
        @endif
    </p>
    <h3 class="text-gray-700 text-2xl  font-light text-center mt-4 text-primary">{{ $post->heading1}}</h3>

    <p class="mt-4 text-lg font-medium ml-0 whitespace-pre-line tracking-wider space-x-4 rounded-lg shadow-xl p-6">
        @if(auth()->check())
             {!! \App\Helpers\replaceWordsWithLinks($post->content1, $links) !!}
        @else
             {!! \Illuminate\Support\Str::limit(\App\Helpers\replaceWordsWithLinks($post->content1, $links), 1000) !!}
            <br>
            <a href="{{ route('login') }}" class="text-blue-500 font-mono">Log in to read more...</a>
        @endif
    </p>

   
</div>

<!-- Related Posts Section -->
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-16">
    <h1 class="text-xl font-bold text-blue-800 text-center text-pretty">Related Posts</h1>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mt-4">
        @foreach($relatedPosts as $related)
        <div class="p-4 bg-white shadow-md rounded-lg">
            <a href="{{ route('news.show', $related->slug) }}" class="block">
                <h3 class="text-lg font-bold text-indigo-600">{{ $related->title }}</h3>
                <p class="text-gray-600 mt-2">{{ Str::limit($related->description, 100) }}</p>
                @if($related->image_url)
                <img src="{{ $related->image_url }}" alt="{{ $related->title }}" class="w-full h-auto mt-4">
                @endif
            </a>
        </div>
        @endforeach
    </div>
</div>
@endsection

<!-- AJAX Script for Likes -->
<script>
function likePost(postId) {
    fetch(`/posts/${postId}/like`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}' // Include CSRF token for security
        },
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Update the likes count in the UI
            const likesCountElement = document.getElementById(`likes-count-${postId}`);
            likesCountElement.textContent = `${data.likes} Likes`;
        }
    })
    .catch(error => console.error('Error:', error));
}
</script>
