@extends('layouts.website')

@section('header')
 @endsection

@section('content')
<style>
    body {
        overflow-x: hidden;
    }
</style>

<div class="p-6">
    <div class="col-md-8 mt-8">
        <form action="{{ route('search.shops') }}" method="GET" class="">
           <input type="text" name="query" id="search-query" class="border p-2 w-full mb-10 rounded-xl shadow text-black border-blue-600  " placeholder="Search..." autocomplete="off">
       </form>
 
    @if($shops->isempty())
        <h1 class="text-center text-xl font-bold">No Item Available....</h1>
    @else
    <div class="grid grid-cols-1 lg:grid-cols-3 md:grid-cols-2 gap-4">
        @foreach($shops as $shop)
            <div class="bg-light rounded-lg shadow-md">
                <h1 class="text-center">{{ $shop->name }}</h1>
                <p>{{ $shop->description }}</p>
<img src="{{$shop->image_url}}" class="w-full h-auto"/>
<div class="row">
    <div class="col-md-4">
        <p class="card-text text-yellow-500">Type: {{ $shop->type }}</p>
    </div>
    <div class="col-md-4">
        <p class="card-text text-purple-500">Size: {{ $shop->size }}</p>
    </div>
    <div class="col-md-4">
        <p class="card-text text-pink-500">Brand: {{ $shop->brand }}</p>
    </div>
</div>
<a href="{{ route('shops.show', $shop->id) }}" class="btn btn-outline-primary">View Product</a>
</div>
        @endforeach</div>
    @endif
</div>
@endsection
