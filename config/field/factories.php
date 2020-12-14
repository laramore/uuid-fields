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
    ManyToOneUuid::class => [
        'formater' => 'relation',
    ],
    OneToOneUuid::class => [
        'formater' => 'relation',
    ],
    
];
