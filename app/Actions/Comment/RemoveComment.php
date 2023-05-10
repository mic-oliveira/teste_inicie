<?php

namespace App\Actions\Comment;

use App\Models\Comment;
use Lorisleiva\Actions\Concerns\AsAction;

class RemoveComment
{
    use AsAction;

    public function handle($comment_id)
    {
        $comment = Comment::find($comment_id);
        $comment->delete();
        return $comment;
    }
}
