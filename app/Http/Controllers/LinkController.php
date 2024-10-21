<?php

namespace App\Http\Controllers;

use App\Models\Link;
use Illuminate\Http\Request;

class LinkController extends Controller
{
    public function create()
    {
        return view('add-link');  }

    /**
     * Store the newly created link in the database.
     */
    public function store(Request $request)
    {
        // Validate the input
        $validatedData = $request->validate([
            'word' => 'required|string|max:255',
            'url' => 'required|url|max:1000',
        ]);

        // Create a new link record in the database
        Link::create([
            'word' => $validatedData['word'],
            'url' => $validatedData['url'],
        ]);

        // Redirect back to the form with a success message
        return redirect()->route('links.create')->with('success', 'Link added successfully!');
    }
}
