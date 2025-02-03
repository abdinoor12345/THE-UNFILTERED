@extends('layouts.admin')
@section('content')
    <div class="container mt-20">
        <div class="row">
            <div class="col-md-12">
                <h1 class="text-center text-blue-600 font-bold">Write and Publish</h1>
                <p class="text-center text-2xl text-black">Here you can write and publish your ebook.</p>
            </div><hr/>
        </div>
        <div class="row">
            <div class="col-md-12">
                <form action="{{ route('ebooks.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" name="title" class="form-control" id="title" placeholder="Enter title">
                    </div>
                    <div class="form-group">
                        <label for="author">Author</label>
                        <input type="text" name="author" class="form-control" id="author" placeholder="Enter author"> 
                    <label for="description">Description</label></div>
                        <textarea name="description" class="form-control" id="description" rows="3" placeholder="Enter description"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="cover_image_url">Cover Image</label>
                        <input type="file" name="cover_image_url" class="form-control-file" id="cover_image_url">
                    </div>
                    <div class="form-group">
                        <label for="file_url">Ebook File (PDF)</label>
                        <input type="file" name="file_url" class="form-control-file" id="file_url">
                    </div>
                    <div class="form-group">
                        <label for="published_date">Published Date</label>
                        <input type="date" name="published_date" class="form-control" id="published_date">
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select name="status" class="form-control" id="status">
                            <option value="available">Available</option>
                            <option value="unavailable">Unavailable</option>
                        </select>
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Publish</button>
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
    </div>
@endsection