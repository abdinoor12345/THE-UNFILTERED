@extends('layouts.admin')

@section('title', 'TRENDING News')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-16">
        @if (Session::has('message'))
            <div class="bg-green-600 text-white text-center rounded p-2">{{ Session::get('message') }}</div>
        @endif

        @if ($errors->any())
            <div class="bg-red-500 text-center text-lg rounded p-2">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li class="text-white">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <p class="text-xl font-bold text-blue-800 text-center">Give Your Opinions and Thoughts Here...</p>

        <form action="{{ route('news.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Title -->
            <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white text-center">TITLE</label>
            <input type="text" id="title" name="title" class="block w-full p-4 text-gray-900 border border-blue-300 rounded-lg bg-gray-50 text-base focus:ring-blue-500 focus:border-blue-800 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required value="{{ old('title') }}">
            @error('title')
                <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
            @enderror

            <!-- Description -->
            <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white text-center">Description</label>
            <input type="text" id="description" name="description" class="block w-full p-4 text-gray-900 border border-blue-300 rounded-lg bg-gray-50 text-base focus:ring-blue-500 focus:border-blue-800 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required value="{{ old('description') }}">
            @error('description')
                <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
            @enderror

            <!-- Content/Message -->
            <label for="content" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white text-center">Your message</label>
            <textarea id="content" name="content" rows="16" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Type here..." required>{{ old('content') }}</textarea>
            @error('content')
                <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
            @enderror
            <p id="contentWordCount" class="text-sm text-gray-600">Word count: 0</p>

            <!-- Optional fields for image URL and links -->
            <label for="image_url" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white text-center">Image URL (Optional)</label>
            <input type="url" id="image_url" name="image_url" class="block w-full p-4 text-gray-900 border border-blue-300 rounded-lg bg-gray-50 text-base focus:ring-blue-500 focus:border-blue-800 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="https://example.com/image.jpg" value="{{ old('image_url') }}">
            @error('image_url')
                <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
            @enderror

            <!-- Header and Content1 -->
            <label for="heading1" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white text-center">Header</label>
            <input type="text" id="heading1" name="heading1" class="block w-full p-4 text-gray-900 border border-blue-300 rounded-lg bg-gray-50 text-base focus:ring-blue-500 focus:border-blue-800 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ old('heading1') }}">
            @error('heading1')
                <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
            @enderror

            <label for="content1" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white text-center">Content1</label>
            <textarea id="content1" name="content1" rows="16" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Type here...">{{ old('content1') }}</textarea>
            @error('content1')
                <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
            @enderror
            <p id="content1WordCount" class="text-sm text-gray-600">Word count: 0</p>

            <!-- Submit Button -->
            <button type="submit" class="mt-2 text-white bg-blue-800 hover:bg-blue-600 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-4 text-center">Submit</button>
        </form>
    </div>

    <!-- Word Count Script -->
    <script>
        const content = document.getElementById('content');
        const contentWordCount = document.getElementById('contentWordCount');
        const content1 = document.getElementById('content1');
        const content1WordCount = document.getElementById('content1WordCount');

        const updateWordCount = (textarea, counter) => {
            const words = textarea.value.trim().split(/\s+/).filter(word => word.length > 0);
            counter.textContent = `Word count: ${words.length}`;
        };

        content.addEventListener('input', () => updateWordCount(content, contentWordCount));
        content1.addEventListener('input', () => updateWordCount(content1, content1WordCount));
    </script>
@endsection
