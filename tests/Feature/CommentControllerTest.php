<?php

namespace Tests\Feature;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class CommentControllerTest extends TestCase
{

    public function test_it_list_comments()
    {
        $comments = Comment::factory()->count(5)->make()->toArray();
        Http::fake([env('GOREST_URL').'/posts/123456/comments' => Http::response($comments)]);
        $response = $this->get('api/posts/123456/comments');
        $response->assertOk();
    }

    public function test_it_list_public_comments()
    {
        $comments = Comment::factory()->count(5)->make()->toArray();
        Http::fake([env('GOREST_URL').'/posts/123456/comments' => Http::response($comments)]);
        $response = $this->get('api/comments');
        $response->assertOk();
    }

    public function test_it_create_comment()
    {
        $comment = Comment::factory()->makeOne()->toArray();
        Http::fake([
            env('GOREST_URL').'/posts/123456/comments' => Http::response($comment, 201)]);
        $response = $this->post('api/posts/123456/comments', $comment);
        $response->assertCreated();
    }

    public function test_it_remove_comment()
    {
        $comment = Comment::factory()->makeOne()->toArray();
        Http::fake([
            env('GOREST_URL').'/comments/654321' => Http::response($comment),
            env('GOREST_URL').'/*' => Http::response([], 204),
        ]);
        $response = $this->delete('api/comments/654321');
        $response->assertNoContent();
    }

    public function test_it_remove_non_exists_comment()
    {
        $comment = Comment::factory()->makeOne()->toArray();
        Http::fake([env('GOREST_URL').'/posts/123456/comments/654321' => Http::response(['message' => 'resource not found'], 404)]);
        $response = $this->delete('api/comments/654321', $comment);
        $response->assertNotFound();
    }

    public function test_it_not_found_comment()
    {
        Http::fake([env('GOREST_URL').'/comments/654321' => Http::response(null, 404)]);
        $response = $this->get('api/comments/654321');
        $response->assertNotFound();
    }

    public function test_it_find_comment()
    {
        $comment = Comment::factory()->makeOne()->toArray();
        Http::fake([
            env('GOREST_URL').'/comments/654321' => Http::response($comment),
        ]);
        $response = $this->get('api/comments/654321');
        $response->assertOk();
    }
}
