<?php

/*
|--------------------------------------------------------------------------
| Auto generate rule
|--------------------------------------------------------------------------
|
| This defines the rule auto_generate.
|
*/

return [

    'description' => 'Auto generate the value',
    'adds' => [
        'required', 'not_nullable',
    ],
    'removes' => [
        'nullable',
    ],

];
