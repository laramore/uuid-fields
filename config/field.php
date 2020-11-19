<?php

namespace Laramore\Fields;

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
        Uuid::class => [
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
        PrimaryUuid::class => [
            'type' => 'primary_uuid',
            'version' => Uuid::VERSION_4,
            'generation' => [],
            'proxy' => [
                'configurations' => [
                    'generate' => [],
                ],
            ],
        ],
        ManyToOneUuid::class => [
            'type' => 'relation',
            'version' => Uuid::VERSION_4,
            'generation' => [],
            'fields' => [
                'id' => Uuid::class,
                'reversed' => Reversed\HasMany::class,
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
