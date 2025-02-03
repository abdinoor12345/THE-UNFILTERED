@extends('layouts.website')
@section('content')

 
<h1 class="text-2xl font-bold text-gray-800 mb-6">Edit Sponsered</h1>
<div class="container mx-auto py-9">

    <form action="{{ route('sponsereds.update', $sponsered->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Title</label>
            <input type="text" name="name" id="name" value="{{ $sponsered->title }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>
        <div class="mb-4">
            <label for="description" class="block text-gray-700 text-sm font-bold mb-2">Description</label>
            <textarea rows="4" name="description" id="description" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">{{ $sponsered->description }}</textarea>
        </div>
        <div class="mb-4">
            <label for="header1" class="block text-gray-700 text-sm font-bold mb-2">Header 1</label>
            <input type="text" name="header1" id="header1" value="{{ $sponsered->header1 }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>
        <div class="mb-4">
            <label for="content1" class="block text gray-700 text-sm font-bold mb-2">Content 1</label>
            <textarea name="content1" id="content1" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">{{ $sponsered->content1 }}</textarea>


</div>

<div class="mb-4">
    <label for="content1" class="block text-gray-700 text-sm font-bold mb-2">Content 1</label>
    <textarea name="content1" id="content1" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">{{ $sponsered->content1 }}</textarea>
</div>
<div class="mb-4">
    <label for="content2" class="block text-gray-700 text-sm font-bold mb-2">Content 2</label>
    <textarea name="content2" id="content2" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">{{ $sponsered->content2 }}</textarea>
</div>
<div class="mb-4">
    <label for="header3" class="block text-gray-700 text-sm font-bold mb-2">Header 3</label>
    <input type="text" name="header3" id="header3" value="{{ $sponsered->header3 }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
</div>
<div class="mb-4">
    <label for="content3" class="block text-gray-700 text-sm font-bold mb-2">Content 3</label>
    <textarea name="content3" id="content3" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">{{ $sponsered->content3 }}</textarea>
</div>
<div class="mb-4">
    <label for="image_url" class="block text-gray-700 text-sm font-bold mb-2">Image URL</label>
    <input type="url" name="image_url" id="image_url" value="{{ $sponsered->image_url }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
</div>
 
<div class="flex items-center justify-between">
    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
        Update
    </button>
    
</div>
@endsection