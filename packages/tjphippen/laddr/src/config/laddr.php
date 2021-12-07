<?php

return [

    /**
     * API route prefix
     */
    'apiPrefix' => 'api',

    /**
     * Route Models
     */
    'models' => [
        'users' => 'User',
    ],

    /**
     * Model Namespace
     */
    'modelNamespace' => 'App\Models',








    /**
     * Prefix for generated routes.
     */
    'baseUrl' => 'glacial',

    /**
     * Number of results to show before enabling pagination.
     */
    'paginate' => '10',

    /**
     * Number of included results to show before enabling pagination.
     */
    'paginateInclude' => '10',

    /**
     * Set recursion limit for nested includes.
     */
    'recursionLimit' => '2',

    /**
     * Set Glacial specific debugging/error responses.
     */
    'debug' => true,

    /**
     * Set include route enabled prefix {@see Glacial::$includes}
     */
    'routeEnabled' => 'api:',

];
