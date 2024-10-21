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
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-16">
    <h1 class="text-2xl font-bold text-blue-800 text-center">{{ $post->title }}</h1>
    <p class="text-gray-700 text-sm font-bold text-center">{{ $post->description }}</p>
    <span class="text-center text-black font-bold">{{ $post->views }} views</span>
    <span class="text-center text-black font-bold  m-2 border-l-2 border-slate-800">{{ $post->user->name }} </span>
    <span class="text-primary">{{ $post->created_at->diffForHumans() }}</span> • 

    @if($post->image_url)
        <img src="{{ $post->image_url }}" alt="{{ $post->title }}" class="w-full h-auto mt-4">
    @endif

    <p class="mt-4 text-lg font-bold ml-0 whitespace-pre-line">
        {!! \App\Helpers\replaceWordsWithLinks($post->content, $links) !!}
    </p> 
    @if($post->important_link)
        <a href="{{ $post->important_link }}" class="text-blue-500 underline" target="_blank">Read More</a>
    @endif

    <!-- Additional Links Section -->
    @if($post->link1 && $post->link_text1)
        <div class="mt-4">
            <a href="{{ $post->link1 }}" class="text-blue-500 underline" target="_blank">
                {{ $post->link_text1 }}
            </a>
        </div>
    @endif

    @if($post->link2 && $post->link_text2)
        <div class="mt-2">
            <a href="{{ $post->link2 }}" class="text-blue-500 underline" target="_blank">
                {{ $post->link_text2 }}
            </a>
        </div>
    @endif

    @if($post->link3 && $post->link_text3)
        <div class="mt-2">
            <a href="{{ $post->link3 }}" class="text-blue-500 underline" target="_blank">
                {{ $post->link_text3 }}
            </a>
        </div>
    @endif
</div>
@endsection
