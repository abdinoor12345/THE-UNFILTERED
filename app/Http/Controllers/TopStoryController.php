<?php

namespace App\Http\Controllers;
use App\Models\Link;
use Illuminate\Support\Facades\Auth;
use App\Models\Top_Story;
use Illuminate\Http\Request;
use Jorenvh\Share\ShareFacade as Share;

class TopStoryController extends Controller
{
    public function create_news()
    {
        return view('TopStory.Create');
    }

    public function store_news(Request $request)
    {
        $user = Auth::user();
        $validatedData = $request->validate([
            'title' => 'string|required|max:255',
            'description' => 'string|required|max:255',
            'content' => 'string|required|max:3500',
            'image_url' => 'nullable|url|max:500',
            'important_link' => 'nullable|url|max:255',
            'link1'=>'nullable|url|max:255',
            'link2'=>'nullable|url|max:255',
            'link3'=>'nullable|url|max:255',
            'link_text1'=>'nullable|url|max:500',
            'link_text2'=>'nullable|url|max:500',
            'link_text3'=>'nullable|url|max:500',

        ]);
        $validatedData['user_id'] = $user->id;
        Top_Story::create($validatedData);

        return redirect()->back()->with('success', 'News submitted successfully!');
    }
    public function Index()
    { $shareButtons = Share::page(
        'https://unfiltered.com/top_stories',    
        'THE UNFILTERED'    
    )
    ->facebook()
    ->twitter()
    ->linkedin()
    ->telegram()
    ->whatsapp();
        $latest = Top_Story::orderBy('created_at', 'desc')->first();
        $popularPosts = Top_Story::orderBy('views', 'desc')->take(3)->get();   

        $news = Top_Story::latest()->skip(1)->paginate(10);
        return view('TopStory/Index', ['news' => $news, 'latest' => $latest,'popularPosts'=>$popularPosts,'shareButtons'=>$shareButtons]);
    }
    public function edit_news($id)
    {
        $Top_Story = Top_Story::find($id);
        return view('TopStory/Edit', compact('Top_Story'));
    }

    public function update_news(Request $request, $id)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'content' => 'required',
            'image_url' => 'nullable|url',
            'important_link' => 'nullable|url',
            'link1'=>'nullable|url|max:255',
            'link2'=>'nullable|url|max:255',
            'link3'=>'nullable|url|max:255',
            'link_text1'=>'nullable|url|max:500',
            'link_text2'=>'nullable|url|max:500',
            'link_text3'=>'nullable|url|max:500',

        ]);

        $Top_Story = Top_Story::find(id: $id);

        $Top_Story->update($validatedData);

        return redirect()->route('top_stories', $Top_Story->id)->with('success', 'News updated successfully!');
    }
    public function show($slug)
    {      $links = Link::all();
        $shareUrl = url('/top_stories/' . $slug);

        // Create share buttons with the dynamically generated URL
        $shareButtons = Share::page(
            $shareUrl,  // Use the dynamically generated URL
            'THE UNFILTERED'
        )
        ->facebook()
        ->twitter()
        ->linkedin()
        ->telegram()
        ->whatsapp();
         $post = Top_Story::where('slug', $slug)->firstOrFail();
      $post->increment('views');
      $relatedPosts = $post->getRelatedPosts();


        return view('TopStory/Show', compact('post','links','relatedPosts','shareButtons'));
    }
    public function destroy_news($id)
    {
        $Top_Story = Top_Story::find($id);

        if ($Top_Story) {
            $Top_Story->delete();
            return redirect()->back();
         }
        return redirect()->route('top_stories')->with('error', 'News not found!');
    }
}
