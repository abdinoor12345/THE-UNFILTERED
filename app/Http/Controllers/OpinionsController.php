<?php

namespace App\Http\Controllers;

use App\Models\Link;
use App\Models\Opinion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Jorenvh\Share\ShareFacade as Share;

class OpinionsController extends Controller
{
    public function create_news(){
        return view('Opinion/Create');
     }
     public function store_news(Request $request){
        $user=Auth::user();
        $validatedData=$request->validate([
            'title'=>'string|required|max:255',
            'description'=>'string|required|max:255',
            'content'=>'string|required|max:3000',
 'image_url' => 'nullable|string|max:255',
        'important_link' => 'nullable|string|max:255',
        'slug'=>'nullable|string|max:255',
        'link1'=>'nullable|url|max:255',
        'link2'=>'nullable|url|max:255',
        'link3'=>'nullable|url|max:255',
        'link_text1'=>'nullable|url|max:500',
        'link_text2'=>'nullable|url|max:500',
        'link_text3'=>'nullable|url|max:500',

        ]

        );
        $validatedData['user_id']=$user->id;
         Opinion::create($validatedData);
        return redirect()->back()->with('success', 'News submitted successfully!');

     }
     public function get_news() {
      $shareButtons = Share::page(
         'https://unfiltered.com/opinions',    
         'THE UNFILTERED'    
     )
     ->facebook()
     ->twitter()
     ->linkedin()
     ->telegram()
     ->whatsapp();
      $popularPosts = Opinion::orderBy('views', 'desc')->take(3)->get();   

      $latest=Opinion::orderBy('created_at','desc')->first();
        $news = Opinion::orderBy('created_at', 'desc')->get();
       return view('Opinion/Index', ['news' => $news,'latest'=>$latest,'popularPosts'=>$popularPosts,'shareButtons'=>$shareButtons]);
   }
   public function show($slug)
{
    $shareButtons = Share::page(
        'https://unfiltered.com/opinions',
        'THE UNFILTERED'
    )->facebook()->twitter()->linkedin()->telegram()->whatsapp();

    $links = Link::all();

     $type = 'politics';  // or adjust dynamically based on model type, e.g., 'sports', 'business'

    $post = Opinion::where('slug', $slug)->firstOrFail();
    $post->increment('views');
    $relatedPosts = $post->getRelatedPosts();
    $likeCount = $post->likes()->count();

    return view('Opinion/Show', compact('post', 'links', 'relatedPosts', 'shareButtons', 'type'));
}public function edit_opinions($id){
   $Opinion=Opinion::findOrFail($id);
   return view('Opinion.Edit',compact('Opinion'));
}

   public function update_opinions(Request $request, $id)
   {
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
   
        $Opinion = Opinion::find(id: $id);
   
        $Opinion->update($validatedData);  
   
        return redirect()->route('opinions', $Opinion->id)->with('success', 'News updated successfully!');
   }
   public function destroy_news($id){
      $Opinion=Opinion::find($id);
      if($Opinion){
         $Opinion->delete();
         return  redirect()->route('opinions')->with('success','news Deleted succefull');
      }
      return redirect()->route('opinions')->with('errror','whoops! error Occured');
   } 

}
