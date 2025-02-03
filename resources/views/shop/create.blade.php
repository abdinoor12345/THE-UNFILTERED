@extends('layouts.website')

@section('content')
    <div class="container mt-32">
        <div class="row">
            <div class="col-md-12">
                <h1 class="text-center text-blue-600 font-bold">Create a Product</h1>
                <p class="text-center text-2xl text-black">Fill out the form below to create a product.</p>
            </div>
        </div>

        <div class="row mt-8">
            <div class="col-md-8 offset-md-2">
                <form action="{{ route('shops.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="name">Product Name:</label>
                        <input type="text" name="name" id="name" class="form-control" required>

                        <label for="description" class="mt-4">Product Description:</label>
                        <textarea name="description" id="description" class="form-control" rows="5" required></textarea>

                        <label for="price" class="mt-4">Product Price:</label>
                        <input type="number" name="price" id="price" class="form-control" required>

                        
                        <label for="category" class="mt-4">Product Category:</label>
                        <input type="text" name="category" id="category" class="form-control" required>

                        <label for="stock" class="mt-4">Product Stock:</label>
                        <input type="number" name="stock" id="stock" class="form-control" required>

                        <label for="image_url" class="mt-4">Product Image URL:</label>
                        <input type="text" name="image_url" id="image_url" class="form-control" required>

                        <label for="type" class="mt-4">Product Type:</label>
                        <input type="text" name="type" id="type" class="form-control" required>

                        <label for="size" class="mt-4">Product Size:</label>
                        <input type="text" name="size" id="size" class="form-control" >

                        <label for="brand" class="mt-4">Product Brand:</label>
                        <input type="text" name="brand" id="brand" class="form-control" >

                        <label for="is_available" class="mt-4">Is Available:</label>
                        <input type="checkbox" name="is_available" id="is_available" value="1" class="form-check-input">
                        
                        <button type="submit" class="mt-8 bg-blue-500 text-white font-bold py-2 px-4 rounded">Create Product</button>
    </div>
@endsection