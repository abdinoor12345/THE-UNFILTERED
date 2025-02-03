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
            @if(session('error'))
                <div class="col-md-12">
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                </div>
            @endif
            <div class="col-md-12">
                 <form action="{{ route('search.shops') }}" method="GET" class="">
                    <input type="text" name="query" id="search-query" class="border p-2 w-full mb-10 rounded-xl shadow text-black border-blue-600  " placeholder="Search..." autocomplete="off">
                </form>

                <h1 class="text-center text-blue-600 font-bold">Buy and Smile</h1>
                <p class="text-center text-2xl text-black">Here you can find all the products we have in our store.</p>
            </div><hr/>
        </div>
        <div class="row">
            @foreach($products as $product)
                <div class="col-md-3">
                    <div class="card mb-4">
                        <img class="card-img-top" src="{{ $product->image_url }}" alt="{{ $product->name }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text">{{ $product->description }}</p>
                            <div class="row">
                                <div class="col-md-4">
                                    <p class="card-text text-red-500">Price: ksh{{ $product->price }}</p>
                                </div>
                                <div class="col-md-4">
                                    <p class="card-text text-green-500">Category: {{ $product->category }}</p>
                                </div>
                                <div class="col-md-4">
                                    <p class="card-text text-blue-500">Stock: {{ $product->stock }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <p class="card-text text-yellow-500">Type: {{ $product->type }}</p>
                                </div>
                                <div class="col-md-4">
                                    <p class="card-text text-purple-500">Size: {{ $product->size }}</p>
                                </div>
                                <div class="col-md-4">
                                    <p class="card-text text-pink-500">Brand: {{ $product->brand }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <p class="card-text text-gray-500"> Available: {{ $product->is_available ? 'Yes' : 'No' }}</p>
                                </div>
                            </div>
                            {{-- <a href="{{ route('cart.add'
                            , $product->id) }}" class="btn btn-primary">Add to Cart</a> --}}
                            <a href="{{ route('shops.show', $product->id) }}" class="btn btn-primary">View Product</a>

                    
                        </div>
                    </div>
                </div>
            @endforeach
        </div> <hr/>
    </div>
    <style>
        .card {
            @apply bg-white rounded-lg shadow-md overflow-hidden;
        }
        .card-img-top {
            @apply w-full h-48 object-cover;
        }
        .card-body {
            @apply p-4;
        }
        .card-title {
            @apply text-xl font-semibold;
        }
        .card-text {
            @apply text-gray-700;
        }
        .btn-primary {
            @apply bg-blue-500 text-white font-bold py-2 px-4 rounded;
        }
    </style>
@endsection