<?php
namespace Wcadena\StringBladeCompiler\Facades;

use Illuminate\Support\Facades\Facade;

class StringView extends Facade
{

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'StringView';
    }
}
