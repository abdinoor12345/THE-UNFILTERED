<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userId = auth()->id(); // Get the authenticated user's ID
        $cart = \DB::table('cart')->where('user_id', $userId)->get();
        return view('cart.index', ['cart' => $cart]);
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function add($id)
    {
        $product = Shop::find($id);
    
        if (!$product) {
            return redirect()->route('cart.index')->with('error', 'Product not found.');
        }
    
        $userId = auth()->id(); // Get the authenticated user's ID
        $cartItem = \DB::table('cart')
            ->where('product_id', $id)
            ->where('user_id', $userId)
            ->first();
    
        if ($cartItem) {
            \DB::table('cart')
                ->where('product_id', $id)
                ->where('user_id', $userId)
                ->update([
                    'quantity' => $cartItem->quantity + 1,
                    'price' => ($cartItem->quantity + 1) * $product->price,
                    'updated_at' => now(),
                ]);
        } else {
            \DB::table('cart')->insert([
                'user_id' => $userId,
                'product_id' => $product->id,
                'name' => $product->name,
                'quantity' => 1,
                'price' => $product->price,
                'image_url' => $product->image_url ?? 'default-image.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    
        return redirect()->route('cart.index')->with('success', 'Product added to cart!');
    }
    


        public function remove($id)
    {
        $cart = Session::get('cart', []);
        
        if (isset($cart[$id])) {
            unset($cart[$id]);
            Session::put('cart', $cart);
        }

        return redirect()->route('cart.index')->with('success', 'Product removed from cart!');
    }
}
