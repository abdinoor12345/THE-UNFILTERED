@extends('layouts.admin')

@section('title', 'TRENDING News')

@section('content')
<div class="max-w-9xl mx-auto px-4 sm:px-6 lg:px-8 mt-16">
    <!-- Success Message -->
    @if (Session::has('success'))
    <div class="bg-green-100 text-green-700 p-3 rounded-lg mt-4 text-center">
        {{ Session::get('success') }}
    </div>
    @endif

    <!-- Form Title -->
    <p class="text-xl font-bold text-blue-800 text-center">Give Your Opinions and Thoughts Here...</p>

    <form action="{{ route('business.store') }}" method="POST" enctype="multipart/form-data" id="newsForm">
        @csrf

        <!-- Title Field -->
        <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white text-center">Title</label>
        <input type="text" id="title" name="title" class="block w-full p-4 text-gray-900 border @error('title') border-red-500 @else border-blue-300 @enderror rounded-lg bg-gray-50 text-base focus:ring-blue-500 focus:border-blue-800 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ old('title') }}">
        @error('title')
        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
        @enderror

        <!-- Description Field -->
        <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white text-center">Description</label>
        <input type="text" id="description" name="description" class="block w-full p-4 text-gray-900 border @error('description') border-red-500 @else border-blue-300 @enderror rounded-lg bg-gray-50 text-base focus:ring-blue-500 focus:border-blue-800 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ old('description') }}">
        @error('description')
        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
        @enderror

        <!-- Content/Message Field -->
        <label for="message" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white text-center">Your Message</label>
        <textarea id="message" name="content" rows="16" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border @error('content') border-red-500 @else border-gray-900 @enderror focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">{{ old('content') }}</textarea>
        @error('content')
        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
        @enderror

        <!-- Word Count -->
        <p class="text-sm text-red-600 mt-2">Word Count: <span id="wordCount">0</span></p>

        <!-- Optional Image URL Field -->
        <label for="image_url" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white text-center">Image URL (Optional)</label>
        <input type="url" id="image_url" name="image_url" class="block w-full p-4 text-gray-900 border border-blue-300 rounded-lg bg-gray-50 text-base focus:ring-blue-500 focus:border-blue-800 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ old('image_url') }}">

        <!-- Optional Link Field -->
        <label for="link" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white text-center">Link (Optional)</label>
        <input type="url" id="link" name="important_link" class="block w-full p-4 text-gray-900 border border-blue-300 rounded-lg bg-gray-50 text-base focus:ring-blue-500 focus:border-blue-800 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ old('important_link') }}">

        <!-- Submit Button -->
        <button type="submit" class="mt-4 px-4 py-2 text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">Submit</button>
    </form>
</div>

<!-- Word Count Script -->
<script>
    const messageField = document.getElementById('message');
    const wordCountDisplay = document.getElementById('wordCount');

    messageField.addEventListener('input', () => {
        const words = messageField.value.trim().split(/\s+/).filter(word => word.length > 0);
        wordCountDisplay.textContent = words.length;
    });
</script>
@endsection
