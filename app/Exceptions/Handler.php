<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Client\RequestException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Throwable $e)
    {
        if ($e instanceof RequestException) {
            $message = $e->response->status() === 422 ? $e->response->collect()->map(function ($item) {
                return ucfirst($item['field']).' '.$item['message'];
            })->first() : $e->getMessage();
            throw new GorestException($message, $e->response->status());
        }

        return parent::render($request, $e); // TODO: Change the autogenerated stub
    }
}