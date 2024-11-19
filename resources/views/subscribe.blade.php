@extends('layouts.website')

@section('title', 'THE UNFILTERED,  About Us')

@section('meta')
    <meta name="description" content="Stay updated with the latest news from The Unfiltered, Global News Agency. We provide unbiased and comprehensive news coverage.">
    <meta name="keywords" content="news, global news, unfiltered news, latest news, current events">
@endsection
<style>body{
    overflow-x: hidden;
}</style>
@section('content') 
<div class="max-w-7xl container mx-auto p-6 mt-10  ">
    <h1 class="text-3xl font-bold mb-4">Subscribe with Us</h1>
    <p class="text-gray-700 mb-6">Stay updated with our latest offers and exclusive content. Subscribe to receive updates directly to your inbox.</p>

    <!-- Display Success Message -->
    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('subscribe.store') }}" method="POST" class="space-y-4">
        @csrf
        <div>
            <label for="email" class="block text-gray-700">Email Address:</label>
            <input type="email" id="email" name="email" required class="w-full border rounded p-2" placeholder="Enter your email">
        </div>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Subscribe</button>
    </form>
</div>

@endsection