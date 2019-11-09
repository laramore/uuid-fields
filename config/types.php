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
        ],
        'primaryUuid' => [
            'default_rules' => [
                'visible', 'required',
            ],
            'default_migration_type' => 'primaryUuid',
            'migration_type' => 'primaryUuid',
        ],
    ],

];
