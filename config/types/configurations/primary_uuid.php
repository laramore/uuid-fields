<?php

/*
|--------------------------------------------------------------------------
| Configuration for the type primary uuid.
|--------------------------------------------------------------------------
|
| This option defines the configuration for the type primary uuid.
|
*/

return [

    'default_rules' => [
        'visible', 'required', 'auto_generate',
    ],
    'default_migration_type' => 'primaryUuid',
    'migration_type' => 'primaryUuid',
    'migration_properties' => [
        'nullable', 'default',
    ],

];
