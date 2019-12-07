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
            'default_rules' => [
                'visible', 'fillable', 'required',
            ],
            'default_migration_type' => 'binaryUuid',
            'migration_type' => 'binaryUuid',
            'migration_properties' => [
                'nullable', 'default',
            ],
        ],
        'primary_uuid' => [
            'default_rules' => [
                'visible', 'required', 'auto_generate',
            ],
            'default_migration_type' => 'primaryUuid',
            'migration_type' => 'primaryUuid',
            'migration_properties' => [
                'nullable', 'default',
            ],
        ],
        'foreign_uuid' => [
            'default_rules' => [
                'visible', 'fillable', 'required',
            ],
            'migration_properties' => [
                'nullable', 'default',
            ],
        ],
    ],

];
