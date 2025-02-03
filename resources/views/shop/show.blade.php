@extends('layouts.website')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 mt-8">
            <form action="{{ route('search.shops') }}" method="GET" class="">
               <input type="text" name="query" id="search-query" class="border p-2 w-full mb-10 rounded-xl shadow text-black border-blue-600  " placeholder="Search..." autocomplete="off">
           </form>

        <div class="col-md-12">
            <h1 class="text-center text-blue-600 font-bold">Product Details</h1>
            <p class="text-center text-2xl text-black underline">Here are the details of the product you selected.</p>
        </div>
    </div>
    <div class="row mt-8">
        <div class="col-md-6 ">
            <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="img-fluid">
        </div>
        <div class="col-md-6">
            <h2 class="text-2xl text-blue-600 font-bold">{{ $product->name }}</h2>
            <p class="text-lg text-black">{{ $product->description }}</p>
            <div class="row">
                <div class="col-md-4">
                    <p class="text-red-500">Price: ksh{{ $product->price }}</p>
                </div>
                <div class="col-md-4">
                    <p class="text-green-500">Category: {{ $product->category }}</p>

</div>
<div class="col-md-4">
    <p class="text-blue-500">Stock: {{ $product->stock }}</p>
</div>
<form  class="" action="{{ route('cart.add', $product->id) }}" method="POST">
    @csrf
    <button type="submit" class="btn btn-primary">Add to Cart</button>
</form>
</div></div><hr/><h1 class="text-center text-primary">Related Products</h1>
<div class="recommended-products">
     <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mt-4">
        @foreach($recommendedProducts as $recommended)
            <div class="bg-light shadow-md rounded-lg p-4">
                <h3 class="text-center text-xl font-light text-balance text-blue">{{ $recommended->name }}</h3>
                 <p class="font-serif text-pink-300 text-center">Price: ${{ $recommended->price }}</p>
                <img src="{{ $recommended->image_url }}" alt="{{ $recommended->name }}">
                <a href="{{ route('shops.show', $recommended->id) }}" class="btn btn-primary">View Product</a>
            </div>
        @endforeach
    </div>
</div>

@endsection