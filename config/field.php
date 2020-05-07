<?php

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
            'proxies' => [
                'generate' => [

                ],
            ],
        ],
        'primary_uuid' => [
            'type' => 'primary_uuid',
            'proxies' => [
                'generate' => [],
            ],
        ],
        'many_to_one_uuid' => [
            'type' => 'relation',
            'fields' => [
                'id' => Laramore\Fields\Uuid::class,
                'reversed' => Laramore\Fields\Reversed\HasMany::class,
            ],
            'templates' => [
                'id' => '${name}_${identifier}',
                'reversed' => '+{modelname}',
                'self_reversed' => 'reversed_+{name}',
            ],
            'proxies' => [],
        ],
    ],
    
];
