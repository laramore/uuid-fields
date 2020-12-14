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
        'type' => 'uuid',
        'property_keys' => [
            'nullable', 'default',
        ],
    ],
    PrimaryUuid::class => [
        'type' => 'uuid',
        'property_keys' => [
            'nullable', 'default',
        ],
    ],
    ManyToOneUuid::class => null,
    
];
