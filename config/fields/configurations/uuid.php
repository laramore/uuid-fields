<?php

/*
|--------------------------------------------------------------------------
| Uuid field
|--------------------------------------------------------------------------
|
| Define all configurations for the uuid field.
|
*/

return [
    
    'type' => 'uuid',
    'proxies' => [
        'relate' => [
            'name_template' => '${fieldname}',
            'requirements' => ['instance'],
        ],
        'where' => [
            'requirements' => ['instance'],
            'targets' => [Laramore\Proxies\ProxyHandler::BUILDER_TYPE],
        ],
        'whereNull' => [
            'name_template' => 'doesntHave^{fieldname}',
            'requirements' => ['instance'],
            'targets' => [Laramore\Proxies\ProxyHandler::BUILDER_TYPE],
        ],
        'whereNotNull' => [
            'name_template' => 'has^{fieldname}',
            'requirements' => ['instance'],
            'targets' => [Laramore\Proxies\ProxyHandler::BUILDER_TYPE],
        ],
        'generate' => [],
    ],

];
