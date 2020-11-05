<?php

namespace App\Http\Controllers;

use App\Post;
use App\User;
use App\Course;
use App\Comment;

use Illuminate\Http\Request;
use App\Http\Requests\StorePostRequest;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $status = "published";
        $posts = Post::latest()->where('status', "=", $status)->paginate(20);
        return view('posts.index', compact('posts'))->with('i', (request()->input('page', 1) - 1) * 20);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index_admin()
    {
        $posts = Post::latest()->paginate(20);
        return view('posts.index_admin', compact('posts'))->with('i', (request()->input('page', 1) - 1) * 20);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $courses =  Course::get();
        foreach ($courses as $course) {
            $course->description = $course->name;
        }
        return view('posts.create', compact('courses'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {
        $data = $request->validated();

        $post = new Post();
        $post->title = $data["title"];
        $post->detail = $data["detail"];
        $post->category = $data["category"];
        // Attach post to user
        $post->user_id = $request->user()->id;
        // End Attach post to user
        $post->save();

        return redirect()->route('posts.index')->with('success', 'Post created successfully. It will be reviewed and published in no time.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        $author =  User::find($post->user_id);
        $post_id = $post->id;
        $comments = Comment::latest()->where('post_id', "=", $post_id)->paginate(5);
        foreach ($comments as $comment) {
            $comment->comment = $comment->comment;
            $commentor =  User::find($comment->user_id);
            $comment->author = $commentor->name;
        }
        return view('posts.show', compact('post', 'author', 'comments'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $courses =  Course::get();
        foreach ($courses as $course) {
            $course->description = $course->name;
        }
        return view('posts.edit', compact('post'), compact('courses'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */

    public function update_status(Post $post){
        $new_status;
        if($post->status == 'pending'){
            $new_status = 'published';
            $post->status = $new_status;
        }
        elseif ($post->status == 'published') {
            $new_status = 'pending';
            $post->status = $new_status;
        }
        $post->update();
        return redirect()->route('index_admin')->with('success', 'Post updated successfully');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(StorePostRequest $request, Post $post)
    {
        $data = $request->validated();
        $post->title = $data["title"];
        $post->detail = $data["detail"];
        $post->category = $data["category"];
        $post->update();
        return redirect()->route('posts.index')->with('success', 'Post updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('posts.index')->with('success', 'Post deleted successfully');
    }
}
