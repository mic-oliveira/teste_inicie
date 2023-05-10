<?php

namespace App\Http\Controllers\Api;

use App\Actions\Comment\CreateComment;
use App\Actions\Comment\ListComments;
use App\Actions\Comment\RemoveComment;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\CommentResource;
use App\Models\Comment;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($post_id = null)
    {
        return CommentResource::collection(ListComments::run($post_id));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $post_id)
    {
        return CommentResource::make(CreateComment::run($request->all(), $post_id));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): CommentResource
    {
        return CommentResource::make(Comment::find($id));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        RemoveComment::run($id);
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
