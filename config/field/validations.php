<?php

namespace Laramore;

return [

    /*
    |--------------------------------------------------------------------------
    | Default uuid validations
    |--------------------------------------------------------------------------
    |
    | This option defines the default uuid validations.
    |
    */

    Fields\Uuid::class => [

    ],
    Fields\PrimaryUuid::class => [

    ],
    Fields\ManyToOneUuid::class => [
        Validations\ArrayObject::class,
    ],
    Fields\ManyToManyUuid::class => [
        Validations\ObjectList::class,
    ],
    Fields\OneToOneUuid::class => [
        Validations\ArrayObject::class,
    ],

];
