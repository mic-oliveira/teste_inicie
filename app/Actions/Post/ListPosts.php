<?php

namespace App\Actions\Post;

use App\Models\Post;
use App\Traits\PaginatedResource;
use Illuminate\Support\Facades\Http;
use Lorisleiva\Actions\Concerns\AsAction;

class ListPosts
{
    use AsAction;
    use PaginatedResource;

    public function handle($user_id = null)
    {
        $gorest = $user_id ? Http::gorest()->get('/users/'.$user_id.'posts'.$this->getQueryParams())
            : Http::gorest()->get('posts'.$this->getQueryParams());
        return $gorest->collect()->map(function ($item) {
            return new Post($item);
        });
    }
}
