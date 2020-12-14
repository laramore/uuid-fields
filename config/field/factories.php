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

    ],
    PrimaryUuid::class => [

    ],
    ManyToOneUuid::class => [
        'formater' => 'relation',
    ],
    ManyToMany::class => [
        'formater' => 'randomRelation',
        'parameters' => [
            'limit' => 2,
        ],
    ],
    OneToOneUuid::class => [
        'formater' => 'relation',
    ],
    
];
