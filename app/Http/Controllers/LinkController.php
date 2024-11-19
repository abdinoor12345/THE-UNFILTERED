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
      */
    public function store(Request $request)
    {
         $validatedData = $request->validate([
            'word' => 'required|string|max:255',
            'url' => 'required|url|max:1000',
        ]);

         Link::create([
            'word' => $validatedData['word'],
            'url' => $validatedData['url'],
        ]);

         return redirect()->route('links.create')->with('success', 'Link added successfully!');
    }
     
    public function edit_links($id)
    {
        $link = Link::findOrFail($id);
        return view('Link.Edit', compact('link'));
    }
    
    public function update_links(Request $request, $id)
    {
        $validatedData = $request->validate([
            'word' => 'required|max:255',
            'url' => 'required|url',
        ]);
    
        $link = Link::findOrFail($id);
        $link->update($validatedData);
    
        return redirect()->route('LinkPage')->with('success', 'Link updated successfully!');
    }
       public function destroy_news($id){
      $link=Link::find($id);
      if($link){
         $link->delete();
         return  redirect()->route('LinkPage')->with('success','news Deleted succefull');
      }
      return redirect()->route( 'LinkPage')->with('errror','whoops! error Occured');
   } 

}
