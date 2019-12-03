<?php

/*
|--------------------------------------------------------------------------
| Configuration for the type uuid.
|--------------------------------------------------------------------------
|
| This option defines the configuration for the type uuid.
|
*/

return [

    'default_rules' => [
        'visible', 'fillable', 'required',
    ],
    'default_migration_type' => 'binaryUuid',
    'migration_type' => 'binaryUuid',
    'migration_properties' => [
        'nullable', 'default',
    ],

];
