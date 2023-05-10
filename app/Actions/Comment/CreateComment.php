<?php

namespace App\Actions\Comment;

use App\Models\Comment;
use Illuminate\Support\Facades\Http;
use Lorisleiva\Actions\Concerns\AsAction;

class CreateComment
{
    use AsAction;

    public function handle($comment, $post_id): Comment
    {
        $comment = array_merge($comment, ['post_id' => $post_id]);
        $gorest = Http::gorest()->post('posts/'.$post_id.'/comments', $comment)->throw();
        $comment = new Comment($gorest->json());
        $comment->wasRecentlyCreated = true;
        return $comment;
    }
}
