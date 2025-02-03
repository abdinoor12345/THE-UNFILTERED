<?php

namespace App\Http\Controllers;

use App\Models\Ebook;
use Illuminate\Http\Request;

class EbookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ebooks=Ebook::all();
        return view('ebooks.index', compact('ebooks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('ebooks.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    $validatedData = $request->validate([
        'title' => 'required|max:255',
        'author' => 'required|max:255',
        'description' => 'nullable',
         'cover_image_url' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'file_url' => 'required|mimes:pdf,doc,docx|max:2048',
        'published_date' => 'nullable|date',
'status' => 'nullable|in:available,unavailable',

    ]);

    Ebook::create($validatedData);

    return redirect()->route('ebooks.index')->with('success', 'Ebook created successfully.');


    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $ebook=Ebook::find($id);

        return view('ebooks.show',compact('ebook'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $ebook=Ebook::findOrFail($id);
        return view('ebooks.edit',compact('ebook'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'author' => 'required|max:255',

            'description' => 'required',
             'cover_image_url' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'file_url' => 'required|mimes:pdf|max:2048',
        ]);

        $ebook=Ebook::findOrFail($id);
        $ebook->update($validatedData);
        
        return redirect()->route('ebooks.index')->with('success', 'Ebook updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $ebooks=Ebook::findOrFail($id);
        $ebooks->delete();
        return redirect()->route('ebooks.index')->with('success', 'Ebook deleted successfully');
    }
}
