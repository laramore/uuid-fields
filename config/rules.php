<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default rules
    |--------------------------------------------------------------------------
    |
    | This option defines the default rules used in fields.
    |
    */

    'configurations' => [
        'auto_generate' => [
            'description' => 'Auto generate the value',
            'adds' => [
                'required', 'not_nullable',
            ],
            'removes' => [
                'nullable',
            ],
        ],
    ],

];
