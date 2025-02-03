@extends('layouts.website')

@section('content')
    <div class="container mt-20">
        <div class="row">
            @if(session('success'))
                <div class="col-md-12">
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                </div>
            @endif
            <a href="contact" class="text-blue-500 font-bold mb-6 text-center ">Write and Publish</a>
<br/>
            @foreach($ebooks as $ebook)
                <div class="col-md-3 mb-2">
                    <div class="card h-100">
                        <img src="{{ $ebook->cover_image_url }}" class="card-img-top img-fluid" alt="{{ $ebook->title }}">
                        <div class="card-body">
                            <h5 class="card-title text-center text-primary">{{ $ebook->title }}</h5>
                            <p class="card-text">{{ Str::limit($ebook->description, 100) }}</p>
                            <p class="card-text"><small class="text-muted">By {{ $ebook->author }}</small></p>
                            <p class="card-text"><small class="text-muted">Published on {{ $ebook->published_date }}</small></p>
                            <a href="{{ route('ebooks.show', $ebook->id) }}" class="btn btn-primary">Read More</a>
                            @if(auth()->check() && auth()->user()->hasRole(['admin', 'editor','super-admin']))
    <button>Edit</button>


                            <form action="{{ route('ebooks.destroy', $ebook->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>@endif
                        </div>
                    </div>
                </div>
            @endforeach
            </div>
            @endsection