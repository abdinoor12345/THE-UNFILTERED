<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    public function index() {
        $videos = Video::all();
        return view('Videos.Video', compact('videos'));
    }

    public function create() {
        return view('videos.create');
    }

    public function store(Request $request) {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'url' => 'required|url',
        ]);

        Video::create($request->all());
        return redirect()->route('videos.index')->with('success', 'Video created successfully.');
    }

    public function edit(Video $video) {
        return view('videos.edit', compact('video'));
    }

    public function update(Request $request, Video $video) {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'url' => 'required|url',
        ]);

        $video->update($request->all());
        return redirect()->route('videos.index')->with('success', 'Video updated successfully.');
    }

    public function show(Video $video) {
        return view('videos.show', compact('video'));
    }

    public function destroy(Video $video) {
        $video->delete();
        return redirect()->route('videos.index')->with('success', 'Video deleted successfully.');
    }
}
