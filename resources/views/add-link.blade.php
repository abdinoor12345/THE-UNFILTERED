@extends('layouts.website')

@section('title', 'Add Word and URL')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-16">
    <h1 class="text-2xl font-bold text-blue-800 text-center">Add Word and URL</h1>
    
    @if(session('success'))
    <div class="bg-green-500 text-white p-4 rounded mb-4">
        {{ session('success') }}
    </div>
    @endif

    <form action="{{ route('links.store') }}" method="POST" class="mt-8">
        @csrf

        <div class="mb-4">
            <label for="word" class="block text-gray-700">Word</label>
            <input type="text" name="word" id="word" class="w-full px-3 py-2 border rounded-md @error('word') border-red-500 @enderror" required>
            
            @error('word')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-4">
            <label for="url" class="block text-gray-700">URL</label>
            <input type="url" name="url" id="url" class="w-full px-3 py-2 border rounded-md @error('url') border-red-500 @enderror" required>
            
            @error('url')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md">Add Link</button>
    </form>
</div>
@endsection
