<?php

namespace App\Traits;

use Illuminate\Support\Facades\Request;

trait PaginatedResource
{
    public function getQueryParams(): string
    {
        return Request::getQueryString() ? '?'.Request::getQueryString() : '';
    }
}
