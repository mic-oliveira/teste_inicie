<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\App;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (App::environment('local')) {
            User::factory()->state(['email' => 'teste@teste.com', 'password' => bcrypt('teste1234')])->create();
            User::factory()->count(5)->create();
        }
    }
}
