<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;

class PostController extends Controller
{
    use GeneralTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $posts = PostResource::collection(Post::get());
            return $this->returnData('posts', $posts);
        } catch (\Exception $e) {
            return $this->returnError($e->getCode(), $e->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostRequest $request)
    {
        try {
            $post = Post::create([
                'title' => $request->title,
                'body' => $request->body
            ]);
            return $this->returnData('Post', new PostResource($post), 'created successfully');
        } catch (\Exception $e) {
            return $this->returnError($e->getCode(), $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try{
            $post = Post::find($id);
            if (!$post) {
                return $this->returnError('E001', 'The post Not Found');
            }
            return $this->returnData('post', new PostResource($post));
        }catch(\Exception $e){
            return $this->returnError($e->getCode(), $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostRequest $request, $id)
    {
        try{
            $post = Post::find($id);
            if (!$post) {
                return $this->returnError('E001', 'The post Not Found');
            }
            $post->update([
                'title' => $request->title,
                'body' => $request->body
            ]);
            return $this->returnData('Post', new PostResource($post), "Updated successfully");
        } catch (\Exception $e) {
            return $this->returnError($e->getCode(), $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{
            $post = Post::find($id);
            if (!$post) {
                return $this->returnError('E001', 'The post Not Found');
            }
            $post->delete();
            return $this->returnSuccessMessage("deleted successfully");
        } catch (\Exception $e) {
            return $this->returnError($e->getCode(), $e->getMessage());
        }
    }
}
