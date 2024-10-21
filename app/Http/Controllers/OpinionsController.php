<?php

namespace App\Http\Controllers;

use App\Models\Link;
use App\Models\Opinion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
      $popularPosts = Opinion::orderBy('views', 'desc')->take(3)->get();   

      $latest=Opinion::orderBy('created_at','desc')->first();
        $news = Opinion::orderBy('created_at', 'desc')->get();
       return view('Opinion/Index', ['news' => $news,'latest'=>$latest,'popularPosts'=>$popularPosts]);
   }
   public function show($slug){
      $links=Link::all();
      $post=Opinion::where('slug', $slug)->firstOrFail();
      $post->increment('views');
      $relatedPosts = $post->getRelatedPosts();

      return view('Opinion/Show',compact('post','links','relatedPosts'));
   }
   public function edit_opinions($id)
   {
       $Opinion = Opinion::find($id);
       return view('Opinion/Edit', compact('Opinion'));
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
   
        return redirect()->route('news.edit', $Opinion->id)->with('success', 'News updated successfully!');
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
