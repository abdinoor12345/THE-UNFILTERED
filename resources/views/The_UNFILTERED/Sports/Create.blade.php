@extends('layouts.website')

@section('title', 'sports')

@section('content')
<div class="max-w-9xl mx-auto px-4 sm:px-6 lg:px-8 mt-16">
    <!-- Success Message -->
    @if (Session::has('success'))
        <div class="text-center text-green-800 text-lg mt-4">{{ Session::get('success') }}</div>
    @endif

    <p class="text-xl font-bold text-blue-800 text-center">Give Your Opinions and Thoughts Here...</p>
    <form action="{{ route('sports.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <!-- Title -->
        <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white text-center">TITLE</label>
        <input type="text" id="title" name="title" class="block w-full p-4 text-gray-900 border border-blue-300 rounded-lg bg-gray-50 text-base focus:ring-blue-500 focus:border-blue-800 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>

        <!-- Description -->
        <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white text-center">Description</label>
        <input type="text" id="description" name="description" class="block w-full p-4 text-gray-900 border border-blue-300 rounded-lg bg-gray-50 text-base focus:ring-blue-500 focus:border-blue-800 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>

        <!-- Content/Message -->
        <label for="message" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white text-center">Your message</label>
        <textarea id="message" name="content" rows="16" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-sm border border-gray-900 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Type here..." required></textarea>

        <!-- Optional Image URL Field -->
        <label for="image_url" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white text-center">Image URL (Optional)</label>
        <input type="url" id="image_url" name="image_url" class="block w-full p-4 text-gray-900 border border-blue-300 rounded-lg bg-gray-50 text-base focus:ring-blue-500 focus:border-blue-800 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="https://example.com/image.jpg">

        <!-- Optional Link Field -->
        <label for="link" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white text-center">Link (Optional)</label>
        <input type="url" id="link" name="important_link" class="block w-full p-4 text-gray-900 border border-blue-300 rounded-lg bg-gray-50 text-base focus:ring-blue-500 focus:border-blue-800 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="https://example.com">
        <label for="category" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white text-center">Category</label>
        <select name="category" id="category" class="block w-full p-4 text-gray-900 border border-blue-300 rounded-lg bg-gray-50 text-base focus:ring-blue-500 focus:border-blue-800 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
            <option value="sport">Sport</option>
            <option value="soccer">Soccer</option>
            <option value="basketball">Basketball</option>
            <option value="cricket">Cricket</option>
            <option value="hockey">Hockey</option>

        </select>
        <!-- Submit Button -->
        <button type="submit" class="mt-4 px-4 py-2 text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">Submit</button>
    </form>
</div>
@endsection
