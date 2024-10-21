@extends('layouts.website')
@section('title', 'TRENDING News')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-16">
        <!-- Display the message if available -->
        @if (Session::has('message'))
            <div class=" bg-green-600 text-white text-center rounded p-2">{{ Session::get('message') }}</div>
        @endif

         @if ($errors->any())
            <div class="bg-red-500 text-center text-lg rounded p-2">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li class="text-white" >{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <p class="text-xl font-bold text-blue-800 text-center">Give Your Opinions and Thoughts Here...</p>

        <form action="{{ route('news.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Title -->
            <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white text-center">TITLE</label>
            <input type="text" id="title" name="title" class="block w-full p-4 text-gray-900 border border-blue-300 rounded-lg bg-gray-50 text-base focus:ring-blue-500 focus:border-blue-800 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ old('title') }}" required>

            <!-- Description -->
            <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white text-center">Description</label>
            <input type="text" id="description" name="description" class="block w-full p-4 text-gray-900 border border-blue-300 rounded-lg bg-gray-50 text-base focus:ring-blue-500 focus:border-blue-800 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ old('description') }}" required>

            <!-- Content/Message -->
            <label for="content" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white text-center">Your message</label>
            <textarea id="content" name="content" rows="16" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Type here..." required>{{ old('content') }}</textarea>

            <!-- Optional fields for image URL and links -->
            <label for="image_url" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white text-center">Image URL (Optional)</label>
            <input type="url" id="image_url" name="image_url" class="block w-full p-4 text-gray-900 border border-blue-300 rounded-lg bg-gray-50 text-base focus:ring-blue-500 focus:border-blue-800 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="https://example.com/image.jpg" value="{{ old('image_url') }}">

            <label for="important_link" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white text-center">Important Link (Optional)</label>
            <input type="url" id="important_link" name="important_link" class="block w-full p-4 text-gray-900 border border-blue-300 rounded-lg bg-gray-50 text-base focus:ring-blue-500 focus:border-blue-800 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="https://example.com" value="{{ old('important_link') }}">

            <!-- Link 1 -->
            <label for="link1" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white text-center">Link 1 (Optional)</label>
            <input type="url" id="link1" name="link1" class="block w-full p-4 text-gray-900 border border-blue-300 rounded-lg bg-gray-50 text-base focus:ring-blue-500 focus:border-blue-800 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="https://example.com" value="{{ old('link1') }}">

            <label for="link_text1" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white text-center">Link Text 1 (Optional)</label>
            <input type="text" id="link_text1" name="link_text1" class="block w-full p-4 text-gray-900 border border-blue-300 rounded-lg bg-gray-50 text-base focus:ring-blue-500 focus:border-blue-800 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ old('link_text1') }}">

            <!-- Link 2 -->
            <label for="link2" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white text-center">Link 2 (Optional)</label>
            <input type="url" id="link2" name="link2" class="block w-full p-4 text-gray-900 border border-blue-300 rounded-lg bg-gray-50 text-base focus:ring-blue-500 focus:border-blue-800 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="https://example.com" value="{{ old('link2') }}">

            <label for="link_text2" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white text-center">Link Text 2 (Optional)</label>
            <input type="text" id="link_text2" name="link_text2" class="block w-full p-4 text-gray-900 border border-blue-300 rounded-lg bg-gray-50 text-base focus:ring-blue-500 focus:border-blue-800 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ old('link_text2') }}">

            <!-- Link 3 -->
            <label for="link3" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white text-center">Link 3 (Optional)</label>
            <input type="url" id="link3" name="link3" class="block w-full p-4 text-gray-900 border border-blue-300 rounded-lg bg-gray-50 text-base focus:ring-blue-500 focus:border-blue-800 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="https://example.com" value="{{ old('link3') }}">

            <label for="link_text3" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white text-center">Link Text 3 (Optional)</label>
            <input type="text" id="link_text3" name="link_text3" class="block w-full p-4 text-gray-900 border border-blue-300 rounded-lg bg-gray-50 text-base focus:ring-blue-500 focus:border-blue-800 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ old('link_text3') }}">

            <!-- Submit Button -->
            <button type="submit" class="w-full text-white bg-blue-800 hover:bg-blue-600 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-4 text-center">Submit</button>
        </form>
    </div>
@endsection
