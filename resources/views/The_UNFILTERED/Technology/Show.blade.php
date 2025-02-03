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
    <h1 class="text-2xl font-bold text-blue-800 text-center border border-lime-400 bg-slate-400">{{ $post->title }}</h1>
    <p class="text-gray-700 text-sm font-bold text-center mb-4">{{ $post->description }}</p>
    <span class="text-center text-black font-bold ">{{ $post->views }} views</span>
    <span class="text-center text-black font-bold  m-2 "> 
        {!! \App\Helpers\replaceWordsWithLinks($post->user->name, $links) !!}
    </span>
    <span class="text-black">{{ $post->created_at->diffForHumans() }}</span> • 
    <div class="social-btn-sp text-center py-4">
        <h1 class="text-primary text-center text-lg">Share Our Contents</h1>
        <div class="flex justify-center space-x-8 text-red-600">
            {!! $shareButtons !!}
        </div>
    </div>
    @if($post->image_url)
        <img src="{{ $post->image_url }}" alt="{{ $post->title }}" class="w-full h-auto mt-1">
    @endif

    <p class="mt-4 text-lg font-bold ml-0 whitespace-pre-line bg-zinc-50 rounded-xl p-6">
        {!! \App\Helpers\replaceWordsWithLinks($post->content, $links) !!}
    </p> 
    

    <!-- Additional Links Section -->
     

    

   
</div>
<div class="  mx-auto px-4 sm:px-6 lg:px-8 mt-16">
    <h2 class="text-xl font-bold text-blue-800 text-center">Related Posts</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mt-4">
        @foreach($relatedPosts as $related)
        <div class="p-4 bg-white shadow-md rounded-lg">
            <a href="{{ route('opinions.show', $related->slug) }}" class="block">
                <h3 class="text-lg font-bold text-indigo-600">{{ $related->title }}</h3>
                <p class="text-gray-600 mt-2">{{ Str::limit($related->description, 100) }}</p>
                @if($related->image_url)
                <img src="{{ $related->image_url }}" alt="{{ $related->title }}" class="w-full h-auto mt-4">
                @endif
            </a>
        </div>
        @endforeach
    </div>
    <div class="code-snippet">
      <pre><code class="language-javascript">
          // Example JavaScript code
          function greet(name) {
              console.log(`Hello, ${name}!`);
          }

          greet('World');
      </code></pre>
  </div>
  </div>
  
@endsection
