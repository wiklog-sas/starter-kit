<?php

namespace Wiklog\StarterKit\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Wiklog\StarterKit\StarterKit
 */
class StarterKit extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Wiklog\StarterKit\StarterKit::class;
    }
}
