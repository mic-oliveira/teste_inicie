<?php

namespace Tests\Feature;

use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class PostControllerTest extends TestCase
{
    use WithFaker;
    use RefreshDatabase;

    const POST_ENDPOINT = 'api/posts';

    public function test_it_list_public_posts()
    {
        $posts = Post::factory()->count(5)->make()->toArray();
        Http::fake([env('GOREST_URL').'/users/685/posts' => Http::response($posts)]);
        $response = $this->getJson(self::POST_ENDPOINT);
        $response->assertOk();
    }

    public function test_it_create_posts()
    {
        $post = Post::factory()->makeOne()->toArray();
        Http::fake([env('GOREST_URL').'/users/685/posts' => Http::response($post, 201)]);
        $response = $this->postJson('api/users/685/posts', $post);
        $response->assertCreated();
    }

    public function test_it_create_public_posts()
    {
        $post = Post::factory()->makeOne()->toArray();
        Http::fake([
            env('GOREST_URL').'/users/685/posts' => Http::response($post, 201),
            env('GOREST_URL').'/posts' => Http::response($post, 201),
        ]);
        $response = $this->postJson('api/posts', $post);
        $response->assertCreated();
    }

    public function test_it_not_found_post()
    {
        Http::fake([env('GOREST_URL').'/posts/654321' => Http::response(null, 404)]);
        $response = $this->get('api/posts/654321');
        $response->assertNotFound();
    }

    public function test_it_find_post()
    {
        $comment = Post::factory()->makeOne()->toArray();
        Http::fake([
            env('GOREST_URL').'/posts/654321' => Http::response($comment),
        ]);
        $response = $this->get('api/posts/654321');
        $response->assertOk();
    }
}
