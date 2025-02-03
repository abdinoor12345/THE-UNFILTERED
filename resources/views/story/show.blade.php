@extends( 'layouts.website')

@section('content')
<div class="bg-black">
    <div class="row">
        <div class="col-md-8 offset-md-2 ">
            <h1 class="text-center text-white mt-8">{{ $story->title }}</h1>
         </div>
    </div>
</div>
    <div class="row">
        <div class="col-md-10 offset-md-2 mx-3">
            <p>Category: {{ $story->category }}</p>
            <p>Published at: {{ \Carbon\Carbon::parse($story->published_at)->format('M d, Y') }}</p>

            @if($story->image_url)
                <img src="{{ $story->image_url }}" alt="{{ $story->title }}" class="w-full h-auto shadow-xl mx-8">
            @endif
             {{-- <p>Author: {{ $story->author->name }}</p> --}}
        </div>
        <hr/>
        <div class="col-md-10 offset-md-2 mx-4 p-8 mt-8">
             <p class="text-xl p-8  font-semi-bold tracking-wide leading-loose bg-slate-50 rounded-xl shadow-2xl">{{ $story->content }}</p>
        </div><h1 class="text-center text-sm text-black">Comments</h1>
        <h5 class="text-center "></h5>
        {{-- <div class="col-md-10 offset-md-2 mx-4  mt-8">
            @foreach($story->comments as $comment)
                <div class="bg-slate-50 rounded-xl shadow-2xl p-4 my-4">
                    <p>{{ $comment->content }}</p>
                    <p class="text-sm text-gray-500">By: {{ $comment->name }}</p>
                </div>
            @endforeach
    </div> --}}
    <h1 class="text-center text-pink-400">Related Stories</h1>
    @endsection