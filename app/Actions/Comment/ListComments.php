<?php

namespace App\Actions\Comment;

use App\Models\Comment;
use App\Traits\PaginatedResource;
use Illuminate\Support\Facades\Http;
use Lorisleiva\Actions\Concerns\AsAction;

class ListComments
{
    use AsAction;
    use PaginatedResource;

    public function handle($post_id = null)
    {
        $gorest = $post_id ? Http::gorest()->get('posts/'.$post_id.'/comments'.$this->getQueryParams())
            : Http::gorest()->get('comments'.$this->getQueryParams());

        return $gorest->collect()->map(function ($item) {
            return new Comment($item);
        });
    }
}
