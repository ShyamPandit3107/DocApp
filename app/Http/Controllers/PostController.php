<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        // return Post::all();
        $post = Post::query()->paginate(20);
        return PostResource::collection($post);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $result = DB::transaction(function () use ($request) {

            $created = Post::create([
                'title' => $request->title,
                'body' => $request->body,
            ]);
            $created->users()->sync($request->user_ids);
            return $created;
        });
        return new PostResource($result);
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return new PostResource($post);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $updated = $post->update([
            'title' => $request->title ?? $post->title,
            'body' => $request->body ?? $post->body,
        ]);
        if ($updated)
            return new PostResource($post);
        else
            return JsonResponse::create(['message' => 'Post not updated'], 500);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return response("the record is deleted", 204);
    }
}
