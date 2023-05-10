<?php

namespace App\Exceptions;

use Symfony\Component\HttpKernel\Exception\HttpException;

class GorestException extends HttpException
{
    public function __construct($message, $code = 500)
    {
        parent::__construct($code, $message ?? 'General gorest exception.');
    }
}
