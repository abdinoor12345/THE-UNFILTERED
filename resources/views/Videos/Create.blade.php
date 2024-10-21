@extends('layouts.website')

@section('content')
<h1>Create New Video</h1>

<form action="{{ route('videos.store') }}" method="POST">
    @csrf

    <div class="form-group">
        <label for="title">Title</label>
        <input type="text" class="form-control" id="title" name="title" required>
        @error('title')
            <small class="text-danger bg-red-600">{{ $message }}</small>
        @enderror
    </div>

    <div class="form-group">
        <label for="description">Description</label>
        <textarea class="form-control" id="description" name="description"></textarea>
    </div>

    <div class="form-group">
        <label for="url">Video URL</label>
        <input type="url" class="form-control" id="url" name="url" required>
        @error('url')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>

    <button type="submit" class="btn btn-primary">Create Video</button>
</form>

<a href="{{ route('videos.index') }}" class="btn btn-secondary mt-3">Back to List</a>
@endsection
