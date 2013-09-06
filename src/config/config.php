<?php

return array(

    /*
    |--------------------------------------------------------------------------
    | Category Model
    |--------------------------------------------------------------------------
    |
    | When using the "eloquent" driver, we need to know which
    | Eloquent models should be used throughout Up.
    |
    */

    'categories' => array(

        'model' => 'Teepluss\Categorize\Categories\Category',
    ),

    /*
    |--------------------------------------------------------------------------
    | Category Hierarchy Model
    |--------------------------------------------------------------------------
    |
    | When using the "eloquent" driver, we need to know which
    | Eloquent models should be used throughout Up.
    |
    */

    'categoryHierarchy' => array(

        'model' => 'Teepluss\Categorize\CategoryHierarchy\Hierarchy',
    ),

    /*
    |--------------------------------------------------------------------------
    | Category Relate Model
    |--------------------------------------------------------------------------
    |
    | When using the "eloquent" driver, we need to know which
    | Eloquent models should be used throughout Up.
    |
    */

    'CategoryRelates' => array(

        'model' => 'Teepluss\Categorize\CategoryRelates\Relate',
    ),

);