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
        Laramore\Fields\Uuid::class => [
            'type' => 'uuid',
        ],
        Laramore\Fields\PrimaryUuid::class => [
            'type' => 'primary_uuid',
        ],
        Laramore\Fields\ForeignUuid::class => [
            'type' => 'foreign_uuid',
        ],
    ],

];
