@extends('layouts.admin')
@section('content')
    <div class="container mt-20">
        <div class="row">
            <div class="col-md-12">
                <h1 class="text-center text-blue-600 font-bold">Edit and Update</h1>
                <p class="text-center text-2xl text-black">Here you can edit and update your ebook.</p>
            </div><hr/>
        </div>
        <div class="row">
            <div class="col-md-12">
                <form action="{{ route('ebooks.update', $ebook->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" name="title" class="form-control" id="title" value="{{ $ebook->title }}">
                    </div>
                    <div class="form-group">
                        <label for="author">Author</label>
                        <input type="text" name="author" class="form-control" id="author" value="{{ $ebook->author }}">
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea name="description" class="form-control" id="description" rows="3">{{ $ebook->description }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="cover_image_url">Cover Image</label>
                        <input type="file" name="cover_image_url" class="form-control-file" id="cover_image_url" value="{{ $ebook->cover_image_url }}">
                    </div>
                    <div class="form-group">
                        <label for="file_url">Ebook File (PDF)</label>
                        <input type="file" name="file_url" class="form-control-file" id="file_url" value="{{ $ebook->file_url }}">
                    </div>
                    <div class="form-group">
                        <label for="published_date">Published Date</label>
                        <input type="date" name="published_date" class="form-control" id="published_date" value="{{ $ebook->published_date }}">
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select name="status" class="form-control" id="status">
                            <option value="available" {{ $ebook->status == 'available' ? 'selected' : '' }}>Available</option>
                            <option value="unavailable" {{ $ebook->status == 'unavailable' ? 'selected' : '' }}>Unavailable</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Update</button>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </form>
            </div>
        </div>


    </div>@endsection