<?php

namespace App\Providers;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Http::macro('gorest', function () {
            return Http::withToken(env('GOREST_TOKEN'))->baseUrl(env('GOREST_URL'));
        });
        JsonResource::withoutWrapping();
    }
}
