@extends('layouts.website')

@section('content')
<div class="container mt-4">
    <h1 class="text-2xl font-bold">Shopping Cart</h1>

    @if($cart->isEmpty())
        <p class="mt-4">Your cart is empty.</p>
    @else
        <table class="table-auto w-full mt-4">
            <thead>
                <tr>
                    <th class="px-4 py-2">Image</th>
                    <th class="px-4 py-2">Product Name</th>
                    <th class="px-4 py-2">Quantity</th>
                    <th class="px-4 py-2">Price</th>
                    <th class="px-4 py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cart as $item)
                    <tr>
                        <td class="border px-4 py-2">
                            <img src="{{ $item->image_url }}" alt="{{ $item->name }}" class="w-16 h-16">
                        </td>
                        <td class="border px-4 py-2">{{ $item->name }}</td>
                        <td class="border px-4 py-2">{{ $item->quantity }}</td>
                        <td class="border px-4 py-2">${{ number_format($item->price, 2) }}</td>
                        <td class="border px-4 py-2">
                            <form action="{{ route('cart.remove', $item->product_id) }}" method="POST">
                                @csrf
                                <button type="submit" class="text-red-500">Remove</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
