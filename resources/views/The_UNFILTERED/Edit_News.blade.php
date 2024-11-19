@extends('layouts.website')

@section('title', 'THE UNFILTERED, GLOBAL NEWS AGENCY')

@section('meta')
    <meta name="description" content="Stay updated with the latest news from The Unfiltered, Global News Agency. We provide unbiased and comprehensive news coverage.">
    <meta name="keywords" content="news, global news, unfiltered news, latest news, current events">
@endsection

@section('content')
<div class="container mx-auto p-6 bg-light max-w-7xl">
    <form action="{{ route( 'trendings.update', $trending->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <!-- Title -->
            <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white text-center">TITLE</label>
            <input type="text" id="title" name="title" value="{{ $trending->title }}" class="block w-full p-4 text-gray-900 border border-blue-300 rounded-lg bg-gray-50 text-base focus:ring-blue-500 focus:border-blue-800 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>

            <!-- Description -->
            <label for="description" class="block mt-4 mb-2 text-sm font-medium text-gray-900 dark:text-white text-center">Description</label>
            <input type="text" id="description" value="{{ $trending->description }}" name="description" class="block w-full p-4 text-gray-900 border border-blue-300 rounded-lg bg-gray-50 text-base focus:ring-blue-500 focus:border-blue-800 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>

            <!-- Content/Message -->
            <label for="message" class="block mt-4 mb-2 text-sm font-medium text-gray-900 dark:text-white text-center">Your message</label>
            <textarea id="message" name="content" rows="8" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Type here..." required>{{ $trending->content }}</textarea>

            <label for="heading1" class="block mt-4 mb-2 text-sm font-medium text-gray-900 dark:text-white text-center">Heading1</label>
            <input type="text" id="heading1" value="{{ $trending->heading1 }}" name="heading1" class="block w-full p-4 text-gray-900 border border-blue-300 rounded-lg bg-gray-50 text-base focus:ring-blue-500 focus:border-blue-800 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>

            <!-- Content/Message -->
            <label for="content1" class="block mt-4 mb-2 text-sm font-medium text-gray-900 dark:text-white text-center">Content1</label>
            <textarea id="content1" name="content1" rows="8" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Type here..." required>{{ $trending->content1 }}</textarea>

            <!-- Optional Image URL Field -->
            <label for="image_url" class="block mt-4 mb-2 text-sm font-medium text-gray-900 dark:text-white text-center">
                Image URL <span class="text-gray-500">(Optional)</span>
            </label>
            <input type="url" id="image_url" value="{{ $trending->image_url }}" name="image_url" class="block w-full p-4 text-gray-900 border border-blue-300 rounded-lg bg-gray-50 text-base focus:ring-blue-500 focus:border-blue-800 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="https://example.com/image.jpg">

            

            
        <!-- Submit Button -->
        <div class="text-center mt-6">
            <button type="submit" class="px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                <i class="fa-solid fa-floppy-disk"></i> Update
            </button>
        </div>
    </form>
</div>
@endsection
