@extends('layouts.admin')

@section('title', 'THE UNFILTERED, Top Stories, Trending')

@section('meta')
    <meta name="description" content="Stay updated with the latest news from The Unfiltered, Global News Agency. We provide unbiased and comprehensive news coverage.">
    <meta name="keywords" content="news, global news, unfiltered news, latest news, current events, T">
@endsection

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-16">
    <main class="container mx-auto bg-transparent mt-8">
        <h1 class="text-lg text-blue-800 text-center font-mono font-extrabold">Add Roles </h1>
        <form action="{{ route('roles.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <!-- Title -->
            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white text-center">Name</label>
            <input type="text" id="name" name="name" class="block w-full p-4 text-gray-900 border border-blue-300 rounded-lg bg-gray-50 text-base focus:ring-blue-500 focus:border-blue-800 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
            <button type="submit" class="mt-4 px-4 py-2 text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">Submit</button>

        </form>    
          
    </main>
</div>
@endsection
