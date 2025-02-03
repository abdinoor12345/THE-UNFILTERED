<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shop;
use Illuminate\Support\Facades\Auth;

class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Shop::orderBy('created_at','desc')->get();
        return view('shop.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    return view('shop.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'category' => 'required',
            'price' => 'required',
            'stock' => 'required',
            'image_url' => 'required',
            'type' => 'required',
            'size' => 'required',
            'brand' => 'required',
            'is_available' => 'required',
        ]);

        Shop::create($request->all());

        return redirect()->route('shops.index')
            ->with('success', 'Product created successfully.');
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
         $product = Shop::find($id);
         $recommendedProducts = $this->getRecommendedProducts($product->category, $product->id);
        return view('shop.show', compact('product', 'recommendedProducts'));
    }
    private function getRecommendedProducts($category, $excludeProductId)
    {
        return Shop::where('category', $category)
                   ->where('is_available', true)
                   ->where('id', '!=', $excludeProductId)
                   ->orderBy('created_at', 'desc')
                   ->take(5)
                   ->get();
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Shop::find($id);
        return view('shop.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'category' => 'required',
            'price' => 'required',
            'stock' => 'required',
            'image_url' => 'required',
            'type' => 'required',
            'size' => 'required',
            'brand' => 'required',
            'is_available' => 'required',
        ]);

        Shop::find($id)->update($request->all());

        return redirect()->route('shops.index')
            ->with('success', 'Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Shop::find($id)->delete();

        return redirect()->route('shops.index')
            ->with('success', 'Product deleted successfully');
    }
    public function manageshop(){
        $products=Shop::all();
        return view('shop.edit-delete',compact('products'));
    }
}
