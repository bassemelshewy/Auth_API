<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::selection()->paginate(PAGINATION_COUNT);
        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostRequest $request)
    {
        try {
            Post::create($request->all());
            return redirect()->route('posts.index')->with('success', 'Data saved successfully');
        } catch (\Exception $e) {
            return redirect()->route('posts.index')->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        try{
            $post = Post::find($id);
            if (!$post)
                return redirect()->route('posts.index')->with('error', 'this post not found');
            return view('posts.edit', compact('post'));
        } catch (\Exception $e) {
            return redirect()->route('posts.index')->withErrors('error', $e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostRequest $request,$id)
    {
        try {
            $post = Post::find($id);
            if (!$post)
                return redirect()->route('posts.index')->with('error', 'this post not found');
            $post->update($request->all());
            return redirect()->route('posts.index')->with('success', 'updated successfully');
        } catch (\Exception $e){
            return redirect()->route('posts.index')->withErrors('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{
            $post = Post::find($id);
            if (!$post)
                return redirect()->route('posts.index')->with('error', 'this post not found');
            $post->delete();
            return redirect()->route('posts.index')->with('delete', 'deleted successfully');
        }catch(\Exception $e){
            return redirect()->route('posts.index')->withErrors('error', $e->getMessage());
        }
    }
}
