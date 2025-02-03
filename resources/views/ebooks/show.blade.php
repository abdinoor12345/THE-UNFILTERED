@extends('layouts.website')

@section('content')
    <div class="container mt-20">
        <div class="row">
            <div class="col-md-12">
                <h1 class="text-center text-blue-600 font-bold">Read and Enjoy</h1>
                <p class="text-center text-2xl text-black">Here you can read and enjoy all the ebooks we have in our library.</p>
            </div><hr/>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <img src="{{ $ebook->cover_image_url }}" class="card-img-top img-fluid" alt="{{ $ebook->title }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $ebook->title }}</h5>
                        <p class="card-text">{{ $ebook->description }}</p>
                        <p class="card-text"><small class="text-muted">By {{ $ebook->author }}</small></p>
                        <p class="card-text"><small class="text-muted">Published on {{ $ebook->published_date }}</small></p>
                        <a href="{{ route('ebooks.index') }}" class="btn btn-primary">Back</a>
                        @if(auth()->check() && auth()->user()->hasRole(['admin', 'editor','super-admin']))
                        <a href="{{ route('ebooks.edit', $ebook->id) }}" class="btn btn-primary">Edit</a>
                        @endif
                        <a  class="btn btn-success"href="">DownLoad</a>
                    </div>
                </div>
            </div>
            
        </div></div>
        @endsection