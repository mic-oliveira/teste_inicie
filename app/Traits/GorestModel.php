<?php

namespace App\Traits;

use App\Exceptions\GorestException;
use Illuminate\Support\Facades\Http;

trait GorestModel
{
    public function __call($method, $parameters)
    {
        try {
            if ($method == 'find') {
                return new $this(Http::gorest()->get($this->table.'/'.$parameters[0])->throw()->json());
            }
        } catch (\Exception $exception) {
            throw new GorestException(ucfirst($this->table).' endpoint not found for id '.$parameters[0], 404);
        }

        return parent::__call($method, $parameters);
    }

    public function delete(): bool
    {
        $status = Http::gorest()->delete($this->table.'/'.$this->id)->throw()->status();

        return $status == 200 || $status === 204;
    }
}
