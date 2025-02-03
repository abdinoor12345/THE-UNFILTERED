@extends('layouts.admin')

@section('content')
<h1 class="text-2xl font-bold text-gray-800 mb-6">Add Contents</h1>

<form action="{{ route('sponsereds.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6 bg-white shadow-md rounded-lg p-6">
    @csrf
    <!-- Title -->
    <div class="space-y-2">
        <label for="title" class="block text-sm font-medium text-gray-700">Title:</label>
        <input type="text" id="title" name="title" value="{{ old('title') }}" 
               class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
        @error('title')<span class="text-sm text-red-600">{{ $message }}</span>@enderror
    </div>

    <!-- Description -->
    <div class="space-y-2">
        <label for="description" class="block text-sm font-medium text-gray-700">Description:</label>
        <textarea id="description" name="description" rows="4" 
                  class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>{{ old('description') }}</textarea>
        @error('description')<span class="text-sm text-red-600">{{ $message }}</span>@enderror
    </div>

    <!-- Header 1 -->
    <div class="space-y-2">
        <label for="header1" class="block text-sm font-medium text-gray-700">Header 1:</label>
        <input type="text" id="header1" name="header1" value="{{ old('header1') }}" 
               class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
        @error('header1')<span class="text-sm text-red-600">{{ $message }}</span>@enderror
    </div>

    <!-- Content 1 -->
    <div class="space-y-2">
        <label for="content1" class="block text-sm font-medium text-gray-700">Content 1:</label>
        <textarea id="content1" name="content1" rows="6" 
                  class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>{{ old('content1') }}</textarea>
        @error('content1')<span class="text-sm text-red-600">{{ $message }}</span>@enderror
    </div>

    <!-- Header 2 -->
    <div class="space-y-2">
        <label for="header2" class="block text-sm font-medium text-gray-700">Header 2:</label>
        <input type="text" id="header2" name="header2" value="{{ old('header2') }}" 
               class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        @error('header2')<span class="text-sm text-red-600">{{ $message }}</span>@enderror
    </div>

    <!-- Content 2 -->
    <div class="space-y-2">
        <label for="content2" class="block text-sm font-medium text-gray-700">Content 2:</label>
        <textarea id="content2" name="content2" rows="6" 
                  class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">{{ old('content2') }}</textarea>
        @error('content2')<span class="text-sm text-red-600">{{ $message }}</span>@enderror
    </div>

    <!-- Header 3 -->
    <div class="space-y-2">
        <label for="header3" class="block text-sm font-medium text-gray-700">Header 3:</label>
        <input type="text" id="header3" name="header3" value="{{ old('header3') }}" 
               class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        @error('header3')<span class="text-sm text-red-600">{{ $message }}</span>@enderror
    </div>

    <!-- Content 3 -->
    <div class="space-y-2">
        <label for="content3" class="block text-sm font-medium text-gray-700">Content 3:</label>
        <textarea id="content3" name="content3" rows="6" 
                  class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">{{ old('content3') }}</textarea>
        @error('content3')<span class="text-sm text-red-600">{{ $message }}</span>@enderror
    </div>

    <!-- Image -->
    <label for="image_url" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white text-center">Image URL (Optional)</label>
    <input type="url" id="image_url" name="image_url" class="block w-full p-4 text-gray-900 border border-blue-300 rounded-lg bg-gray-50 text-base focus:ring-blue-500 focus:border-blue-800 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="https://example.com/image.jpg">


    

   
    <!-- Submit Button -->
    <div class="flex justify-end">
        <button type="submit" 
                class="px-4 py-2 bg-indigo-600 text-white rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
            Create Sponsored
        </button>
    </div>
</form>
@endsection
