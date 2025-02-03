<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Story;
use Illuminate\Support\Str;

class StoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $news=Story::orderBy('created_at','desc')->first();
        $stories=Story::orderBy('created_at','desc')->get();

        return view('story.index',['stories'=>$stories,'news'=>$news]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('story.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string|max:3000',
            'image_url' => 'nullable|url|max:255',
            'category' => 'required|string|max:255',
        ]);

        $validatedData['author_id'] = auth()->id();

        $validatedData['published_at'] = now();
        $validatedData['slug'] = Str::slug($validatedData['title']);
        Story::create($validatedData);

        return redirect()->route('stories.index')
            ->with('success', 'Story created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $slug)
    {
        $story = Story::where('slug', $slug)->firstOrFail();
        $story->increment('views');

        return view('story.show', ['story' => $story]);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $story = Story::find($id);
        return view('story.edit', ['story' => $story]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string|max:3000',
            'image_url' => 'nullable|url|max:255',
              'category' => 'required|string|max:255',
         ]);

        Story::whereId($id)->update($validatedData);

        return redirect()->route('stories.index')
            ->with('success', 'Story updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $story = Story::find($id);
        $story->delete();

        return redirect()->route('storys.index')
            ->with('success', 'Story deleted successfully');
    }
    public function manage(){
        $stories=Story::orderBy('created_at','desc')->get();
        return view('story.edit-delete',['stories'=>$stories]);
    }
}
