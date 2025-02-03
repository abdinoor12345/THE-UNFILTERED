@extends('layouts.website')

@section('content')
<div class="container mt-20 shadow-lg rounded md bg-ligh">
    <div class="row">
        <div class="col-md-12">
            <h1 class="text-center text-blue-600 font-bold">Edit Product</h1>
            <p class="text-center text-2xl text-black">Fill out the form below to edit a product.</p>
        </div>
    </div>

    <div class="row mt-8">
        <div class="col-md-8 offset-md-2">
            <form action="{{ route('shops.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name">Product Name:</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ $product->name }}" required>

                    <label for="description" class="mt-4">Product Description:</label>
                    <textarea name="description" id="description" class="form-control" rows="5" required>{{ $product->description }}</textarea>

                    <label for="price" class="mt-4">Product Price:</label>
                    <input type="number" name="price" id="price" class="form-control" value="{{ $product->price }}" required>

                    <label for="category" class="mt-4">Product Category:</label>
                    <input type="text" name="category" id="category" class="form-control" value="{{ $product->category }}" required>

                    <label for="stock" class="mt-4">Product Stock:</label>
                    <input type="number" name="stock" id="stock" class="form-control" value="{{ $product->stock }}" required>

                    <label for="image_url" class="mt-4">Product Image URL:</label>
                    <input type="text" name="image_url" id="image_url" class="form-control" value="{{ $product->image_url }}" required>

                    <label for="type" class="mt-4">Product Type:</label>
                    <input type="text" name="type" id="type" class="form-control" value="{{ $product->type }}" required>

                    <label for="size" class="mt-4">Product Size:</label>
                    <input type="text" name="size" id="size" class="form-control" value="{{ $product->size }}" >

                    <label for="brand" class="mt-4">Product Brand:</label>
                    <input type="text" name="brand" id="brand" class="form-control" value="{{ $product->brand }}" >

                    <label for="is_available" class="mt-4">Is Available:</label>
                    <input type="checkbox" name="is_available" id="is_available" value="1" class="form-check-input" {{ $product->is_available ? 'checked' : '' }}>

                    <button class="btn btn-primary mt-8">Update Product</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
 </div>
@endsection
