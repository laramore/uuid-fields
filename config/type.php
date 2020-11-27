<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default uuid types
    |--------------------------------------------------------------------------
    |
    | This option defines the default uuid types used by fields.
    |
    */

    'configurations' => [
        'uuid' => [
            'default_options' => [
                'visible', 'fillable',
            ],
            'migration_name' => 'uuid',
            'migration_property_keys' => [
                'nullable', 'default',
            ],
        ],
        'primary_uuid' => [
            'default_options' => [
                'visible', 'auto_generate',
            ],
            'migration_name' => 'uuid',
            'factory_name' => null,
            'migration_property_keys' => [
                'nullable', 'default',
            ],
        ],
    ],

];
