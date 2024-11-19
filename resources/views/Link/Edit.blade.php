@extends('layouts.website')

@section('title', 'THE UNFILTERED, GLOBAL NEWS AGENCY')

@section('content')
<div class="container mx-auto p-6 bg-light max-w-7xl">
    <form action="{{ route('links.update', $link->id) }}" method="POST">
        @csrf
        @method('PUT')
        @if (session('success'))
        <div class="p-4 mb-6 text-green-700 bg-green-100 border border-green-400 rounded-lg">
            {{ session('success') }}
        </div>
    @elseif (session('error'))
        <div class="p-4 mb-6 text-red-700 bg-red-100 border border-red-400 rounded-lg">
            {{ session('error') }}
        </div>
    @endif
        <div class="mb-4">
             <label for="word" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white text-center">Word</label>
            <input type="text" id="word" name="word" value="{{ $link->word }}" class="block w-full p-4 text-gray-900 border border-blue-300 rounded-lg bg-gray-50 text-base focus:ring-blue-500 focus:border-blue-800 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
            
             <label for="url" class="block mt-4 mb-2 text-sm font-medium text-gray-900 dark:text-white text-center">URL</label>
            <input type="url" id="url" name="url" value="{{ $link->url }}" class="block w-full p-4 text-gray-900 border border-blue-300 rounded-lg bg-gray-50 text-base focus:ring-blue-500 focus:border-blue-800 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="https://example.com">
        </div>

         <div class="text-center mt-6">
            <button type="submit" class="px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                <i class="fa-solid fa-floppy-disk"></i> Update
            </button>
        </div>
    </form>
</div>
@endsection
