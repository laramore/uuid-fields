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

    Uuid::class => [
        'version' => Uuid::VERSION_4,
        'factory_parameters' => [],
        'options' => [
            'select', 'visible', 'fillable', 'required',
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
            'select', 'visible',
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
    ManyToManyUuid::class => [
        'options' => [
            'visible', 'fillable',
        ],
        'pivot_namespace' => 'App\\Pivots',
        'fields' => [
            'reversed' => Reversed\BelongsToMany::class,
        ],
        'pivot_field' => ManyToOneUuid::class,
        'templates' => [
            'reversed' => '+{modelname}',
            'pivot' => 'pivot',
            'reversed_pivot' => 'pivot',
            'self_reversed' => 'reversed_+{name}',
            'self_reversed_pivot' => 'reversed_+{modelname}',
        ],
    ],
    OneToOneUuid::class => [
        'options' => [
            'visible', 'fillable', 'required',
        ],
        'fields' => [
            'id' => UniqueId::class,
            'reversed' => Reversed\HasOne::class,
        ],
        'templates' => [
            'id' => '${name}_${identifier}',
            'reversed' => '${modelname}',
            'self_reversed' => 'reversed_+{name}',
        ],
    ],
];
