@extends('layouts.website')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1 class="text-center text-blue-600 font-bold">Sponsered Details</h1>
            <p class="text-center text-2xl text-black underline">Here are the details of the posts.</p>
        </div>
    </div>
    <div class="row mt-8">
        <div class="col-md-6 ">
            <img src="{{ $sponsered->image_url }}" alt="{{ $sponsered->name }}" class="img-fluid">
        </div>
        <div class="col-md-6">
            <h2 class="text-2xl text-blue-600 font-bold">{{ $sponsered->name }}</h2>
            <p class="text-lg text-black">{{ $sponsered->description }}</p>
            <h3 class="text-xl text-blue-600 font-bold">{{ $sponsered->header1 }}</h3>
            <p class="text-lg text-black">{{ $sponsered->content1 }}</p>
            <h3 class="text-xl text-blue-600 font-bold">{{ $sponsered->header2 }}</h3>
            <p class="text-lg text-black">{{ $sponsered->content2 }}</p>
            <h3 class="text-xl text-blue-600 font-bold">{{ $sponsered->header3 }}</h3>
            <p class="text-lg text-black">{{ $sponsered->content3 }}</p>
            
</div>
@endsection