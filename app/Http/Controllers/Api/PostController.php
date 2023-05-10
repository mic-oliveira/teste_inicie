<?php

namespace App\Http\Controllers\Api;

use App\Actions\Post\CreatePost;
use App\Actions\Post\ListPosts;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($user_id = null): AnonymousResourceCollection
    {
        return PostResource::collection(ListPosts::run($user_id));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $user_id = null): PostResource
    {
        return PostResource::make(CreatePost::run($request->all(), $user_id));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return PostResource::make(Post::find($id));
    }
}
