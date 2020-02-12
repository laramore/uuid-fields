<?php

$commonProxies = [
    'relate' => [
        'name_template' => '${fieldname}',
        'requirements' => ['instance'],
    ],
    'where' => [
        'requirements' => ['instance'],
        'targets' => [Laramore\Fields\Proxy\ProxyHandler::BUILDER_TYPE],
    ],
    'whereNull' => [
        'name_template' => 'doesntHave^{fieldname}',
        'requirements' => ['instance'],
        'targets' => [Laramore\Fields\Proxy\ProxyHandler::BUILDER_TYPE],
    ],
    'whereNotNull' => [
        'name_template' => 'has^{fieldname}',
        'requirements' => ['instance'],
        'targets' => [Laramore\Fields\Proxy\ProxyHandler::BUILDER_TYPE],
    ],
];

return [

    /*
        |--------------------------------------------------------------------------
        | Default uuid fields
        |--------------------------------------------------------------------------
        |
        | This option defines the default uuid fields.
        |
    */

    'configurations' => [
        'uuid' => [
            'type' => 'uuid',
            'proxies' => \array_merge($commonProxies, [
                'generate' => [],
            ]),
        ],
        'primary_uuid' => [
            'type' => 'primary_uuid',
            'proxies' => \array_merge($commonProxies, [
                'generate' => [],
            ]),
        ],
        'foreign_uuid' => [
            'type' => 'foreign_uuid',
            'fields' => [
                'id' => [
                    Laramore\Fields\Uuid::class,
                    ['visible', 'fillable', 'not_zero'],
                ],
            ],
            'links' => [],
            'field_name_template' => '${name}_${fieldname}',
            'link_name_template' => '*{modelname}',
            'proxies' => $commonProxies,
        ],
    ],
];
