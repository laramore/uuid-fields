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
            'version' => Uuid::VERSION_4,
            'factory_parameters' => [],
            'options' => [
                'visible', 'fillable', 'required',
            ],
            'proxy' => [
                'configurations' => [
                    'generate' => [
    
                    ],
                ]
            ],
        ],
        PrimaryUuid::class => [
            'options' => [
                'visible', 'auto_generate',
            ],
            'version' => Uuid::VERSION_4,
            'factory_parameters' => [],
            'proxy' => [
                'configurations' => [
                    'generate' => [],
                ],
            ],
        ],
        ManyToOneUuid::class => [
            'version' => Uuid::VERSION_4,
            'factory_parameters' => [],
            'options' => [
                'visible', 'fillable', 'required',
            ],
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
