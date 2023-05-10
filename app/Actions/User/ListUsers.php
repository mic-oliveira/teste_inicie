<?php

namespace App\Actions\User;

use App\Models\User;
use App\Traits\PaginatedResource;
use Illuminate\Support\Facades\Http;
use Lorisleiva\Actions\Concerns\AsAction;

class ListUsers
{
    use AsAction;
    use PaginatedResource;

    public function handle()
    {
        return Http::gorest()->get('users'.$this->getQueryParams())->throw()->collect()->map(function ($item) {
            return new User($item);
        });
    }
}
