<?php

use Laramore\Fields\Uuid;

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
            'version' => Uuid::VERSION_4,
            'generation' => [],
            'proxy' => [
                'configurations' => [
                    'generate' => [
    
                    ],
                ]
            ],
        ],
        'primary_uuid' => [
            'type' => 'primary_uuid',
            'version' => Uuid::VERSION_4,
            'generation' => [],
            'proxy' => [
                'configurations' => [
                    'generate' => [],
                ],
            ],
        ],
        'many_to_one_uuid' => [
            'type' => 'relation',
            'version' => Uuid::VERSION_4,
            'generation' => [],
            'fields' => [
                'id' => Laramore\Fields\Uuid::class,
                'reversed' => Laramore\Fields\Reversed\HasMany::class,
            ],
            'templates' => [
                'id' => '${name}_${identifier}',
                'reversed' => '+{modelname}',
                'self_reversed' => 'reversed_+{name}',
            ],
            'proxy' => [
                'configurations' => [
            
                ],
            ],
        ],
    ],
    
];
