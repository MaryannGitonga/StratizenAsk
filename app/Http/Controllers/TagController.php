<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tag;
use App\Post;

class TagController extends Controller
{
    public function index(Tag $tag = null)
    {
       $tags=Tag::orderBy('name')->paginate(12);
        $title='Tags';
        return view('tags.index')->with('tags',$tags);
    }
    public function create()
    {

    }

    public function store(Request $request)
    {

    }

    public function show(Tag $tag = null)
    {   
        $posts = $tag->posts; 
 
        return view('tags.selected', compact('posts','tag'));    
    }

    public function search(Request $request)
    {
        $query=$request->input('query');
        $tags = Tag::where('name','like',"%$query%")->paginate(12); 
        return view('tags.searchresults')->with('tags',$tags);
    }

    public function edit($id)
    {

    }

    public function update($id)
    {

    }

    public function destroy($id)
    {

    }
}
