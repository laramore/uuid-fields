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
        'Laramore\\Fields\\Uuid' => [
            'type' => 'uuid',
        ],
        'Laramore\\Fields\\PrimaryUuid' => [
            'type' => 'primary_uuid',
        ],
        'Laramore\\Fields\\ForeignUuid' => [
            'type' => 'foreign_uuid',
        ],
    ],

];
