<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    use WithFaker;
    use RefreshDatabase;

    const USER_ENDPOINT = 'api/users';

    public function test_it_create_a_user(): void
    {
        $user = User::factory()->make()->toArray();
        Http::fake([env('GOREST_URL').'/users' => Http::response($user)]);
        $response = $this->postJson(self::USER_ENDPOINT, $user);

        $response->assertStatus(201);
        $response->assertJsonStructure(['id', 'name', 'email', 'gender', 'status']);
    }

    public function test_api_exception()
    {
        Http::fake([env('GOREST_URL').'/users' => Http::response([['field' => 'email', 'message' => 'has already been taken']], 422)]);
        $response = $this->postJson(self::USER_ENDPOINT, ['email' => 'teste@teste.com']);
        $response->assertStatus(422);
    }

    public function test_it_list_users()
    {
        $users = User::factory()->count(10)->state(['id' => rand(1, 999999)])->make()->toArray();
        Http::fake([env('GOREST_URL').'/users' => Http::response($users)]);
        $response = $this->getJson(self::USER_ENDPOINT);
        $response->assertStatus(200);
    }

    public function test_it_find_users()
    {
        $user = User::factory()->state(['id' => '123456', 'status' => 'active'])->make();
        Http::fake([env('GOREST_URL').'/*' => Http::response($user)]);
        $response = $this->getJson(self::USER_ENDPOINT.'/123456');
        $response->assertStatus(200);
    }

    public function test_it_users_not_found_on_api()
    {
        Http::fake([env('GOREST_URL').'/*' => Http::response([], 404)]);
        $response = $this->getJson(self::USER_ENDPOINT.'/123456');
        $response->assertStatus(404);
    }

    public function test_empty_response_from_api()
    {
        Http::fake([env('GOREST_URL').'/*' => Http::response([])]);
        $response = $this->getJson(self::USER_ENDPOINT.'/123456');
        $response->assertStatus(200);
    }
}
