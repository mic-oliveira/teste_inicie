<?php

namespace App\Actions\Comment;

use App\Actions\Post\ListPosts;
use App\Models\Comment;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Request;
use Lorisleiva\Actions\Concerns\AsAction;

class CreateComment
{
    use AsAction;

    public function handle($comment, $post_id = null): Comment
    {
        if (Request::query('first_post', false)) {
            $post_id = ListPosts::run()->first()->id;
        }
        $gorest = $post_id ? Http::gorest()->post('posts/'.$post_id.'/comments', $comment)->throw()
            : Http::gorest()->post('comments', $comment)->throw();
        $comment = new Comment($gorest->json());
        $comment->wasRecentlyCreated = true;

        return $comment;
    }
}
