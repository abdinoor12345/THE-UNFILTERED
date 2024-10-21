@extends('layouts.website')

@section('title', $post->title)

@section('meta')
    <meta name="description" content="{{ $post->description }}">
@endsection

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-16 border-l-4 border-indigo-500">
    <!-- Post Content -->
    <h1 class="text-2xl font-bold text-blue-800 text-center underline mb-2">{{ $post->title }}</h1>
    <p class="text-gray-700 text-sm font-bold text-center">{{ $post->description }}</p>
    <span class="text-center text-primary font-bold lg:mx-6">{{ $post->views }} views</span>
    @if ($post->user)
        <span class="text-center text-primary font-bold lg:mx-8">   
                 {!! \App\Helpers\replaceWordsWithLinks($post->user->name, $links) !!}
        </span>
    @else
        <span class="text-center text-gray-500">Anonymous</span>
    @endif
    <span class="text-primary">{{ $post->created_at->diffForHumans() }}</span> • 
    @if($post->image_url)
        <img src="{{ $post->image_url }}" alt="{{ $post->title }}" class="w-full h-auto mt-4">
    @endif
    <p class="mt-4 text-lg font-bold ml-0 whitespace-pre-line tracking-wider space-x-4">
        {!! \App\Helpers\replaceWordsWithLinks($post->content, $links) !!}
    </p>
    @if($post->important_link)
        <a href="{{ $post->important_link }}" class="text-blue-500 underline" target="_blank">Read More</a>
    @endif

    <!-- Like Button -->
    <div class="flex items-center mt-4">
        <button id="like-button-{{ $post->id }}" class="bg-blue-500 text-white px-4 py-2 rounded" onclick="likePost({{ $post->id }})">
            Like
        </button>
        <span id="likes-count-{{ $post->id }}" class="ml-2">{{ $post->likes }} Likes</span>
    </div>
</div>

<!-- Related Posts Section -->
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-16">
    <h2 class="text-xl font-bold text-blue-800 text-center">Related Posts</h2>
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
