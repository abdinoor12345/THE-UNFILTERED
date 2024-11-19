@extends('layouts.website')

@section('title', $post->title)

@section('meta')
    <meta name="description" content="{{ $post->description }}">
@endsection

@section('structured-data')
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Article",
  "headline": "{{ $post->title }}",
  "image": [
    "{{ $post->image_url }}"
   ],
  "datePublished": "{{ $post->created_at }}",
  "author": {
    "@type": "Person",
    "name": "Your Author Name"
  },
  "publisher": {
    "@type": "Organization",
    "name": "Your Website Name",
    "logo": {
      "@type": "ImageObject",
      "url": "https://yourwebsite.com/logo.png"
    }
  },
  "description": "{{ $post->description }}"
}
</script>
@endsection

@section('content')
<div class="max-w-9xl mx-auto px-4 sm:px-6 lg:px-8 mt-16">
    <h1 class="text-2xl font-bold text-blue-800 text-center">{{ $post->title }}</h1>
    <p class="text-gray-700 text-lg font-bold text-center">{{ $post->description }}</p>
    <span class="text-center text-black font-bold">{{ $post->views }} views</span>
    @if ($post->user)
    <span class="text-center text-primary font-bold  m-2  ">  {!! \App\Helpers\replaceWordsWithLinks($post->user->name, $links) !!}
    </span>

    @endif
     <span class="text-black">{{ $post->created_at->diffForHumans() }}</span> • 

     <div class="social-btn-sp text-center py-4">
      <h1 class="text-blue-900 font-bold text-center text-lg">Share Our Contents</h1>
      <div class=" flex justify-left space-x-2 text-red-600">
          {!! $shareButtons !!}
      </div>
  </div> 
    @if($post->image_url)

    <img src="{{ $post->image_url }}" alt="{{ $post->title }}" class="w-full h-auto mt-4">@endif
    <p class="mt-4 text-lg font-bold ml-0 whitespace-pre-line">
      {!! \App\Helpers\replaceWordsWithLinks($post->content, $links) !!}
  </p>    @if($post->important_link)
        <a href="{{ $post->important_link }}" class="text-blue-500 underline" target="_blank">Read More</a>
    @endif
</div>
<!-- Related Posts Section -->
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-16">
  <h2 class="text-xl font-bold text-blue-800 text-center">Related Posts</h2>
  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mt-4">
      @foreach($relatedPosts as $related)
      <div class="p-4 bg-white shadow-md rounded-lg">
          <a href="{{ route('top_stories.show', $related->slug) }}" class="block">
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
