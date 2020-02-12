<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default options
    |--------------------------------------------------------------------------
    |
    | This option defines the default options used in fields.
    |
    */

    'configurations' => [
        'auto_generate' => [
            'description' => 'Auto generate the value',
            'adds' => [
                'not_nullable',
            ],
            'removes' => [
                'nullable', 'fillable',
            ],
        ],
    ],

];
