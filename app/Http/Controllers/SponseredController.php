<?php

namespace App\Http\Controllers;

use App\Models\Sponsered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SponseredController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    $sponsereds = Sponsered::orderBy('created_at', 'desc')->get(); // Retrieve all posts
    return view('Sponsered.Index', compact('sponsereds'));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Sponsered.Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {        $user=Auth::user();

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:900',
            'header1' => 'required|string|max:255',
            'content1' => 'required|string',
            'header2' => 'nullable|string|max:255',
            'content2' => 'nullable|string',
            'header3' => 'nullable|string|max:255',
            'content3' => 'nullable|string',
            'image_url' => 'nullable|url',
            
          ]);       
          $validated['user_id']=$user->id;
           Sponsered::create($validated);
           return redirect()->route('sponsereds.index')->with('success', 'Sponsered post created successfully!');

    }

    /**
     * Display the specified resource.
     */
    public function show( $slug)
    
    {       $sponsered = Sponsered::where('slug', $slug)->firstOrFail();
        $sponsered->increment('views');

     return view('Sponsered.Show', compact('sponsered'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
      $sponsered = Sponsered::findOrFail($id);
    return view('Sponsered.Edit', compact('sponsered'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
{
    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|string|max:900',
        'header1' => 'required|string|max:255',
        'content1' => 'required|string',
        'header2' => 'nullable|string|max:255',
        'content2' => 'nullable|string',
        'header3' => 'nullable|string|max:255',
        'content3' => 'nullable|string',
        'image_url' => 'nullable|url',
     ]);

    $sponsered = Sponsered::findOrFail($id);
    $sponsered->update($validated);

    return redirect()->route('sponsereds.show', $sponsered->id)->with('success', 'Sponsored post updated successfully!');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $sponsered = Sponsered::find($id);
        $sponsered->delete();
        return redirect()->route('sponsereds.index')->with('success', 'Sponsered post deleted successfully!');
    }
}
