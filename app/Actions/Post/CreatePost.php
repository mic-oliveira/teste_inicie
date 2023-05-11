<?php

namespace App\Actions\Post;

use App\Models\Post;
use Illuminate\Support\Facades\Http;
use Lorisleiva\Actions\Concerns\AsAction;

class CreatePost
{
    use AsAction;

    public function handle(array $post, $user_id = null): Post
    {
        $gorestPost = $user_id ? Http::gorest()->post('users/'.$user_id.'/posts', array_merge($post, ['user_id' => $user_id]))->throw()->json()
            : Http::gorest()->post('/posts', $post)->throw()->json();
        $post = new Post($gorestPost);
        $post->wasRecentlyCreated = true;

        return $post;
    }
}
