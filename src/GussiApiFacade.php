<?php

namespace GussiApi;

use Illuminate\Support\Facades\Facade;

class GussiApiFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return GussiApiClient::class;
    }
}
