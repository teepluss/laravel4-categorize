<?php namespace Teepluss\Categorize\Facades;

use Illuminate\Support\Facades\Facade;

class Categorize extends Facade {

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor() { return 'categorize'; }

}