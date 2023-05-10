<?php

namespace App\Actions\User;

use App\Models\User;
use Illuminate\Support\Facades\Http;
use Lorisleiva\Actions\Concerns\AsAction;

class CreateUser
{
    use AsAction;

    public function handle(array $user): User
    {

        $gorest = Http::gorest()
            ->post('users', $user)
            ->throw();
        $user = new User($gorest->json());
        $user->wasRecentlyCreated = true;

        return $user;
    }
}
