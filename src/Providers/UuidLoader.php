<?php
/**
 * Add the field Uuid as a Type.
 *
 * @author Samy Nastuzzi <samy@nastuzzi.fr>
 *
 * @copyright Copyright (c) 2019
 * @license MIT
 */

namespace Laramore\Providers;

use Illuminate\Support\ServiceProvider;
use Laramore\Facades\TypeManager;

class UuidLoader extends ServiceProvider
{
    /**
     * Prepare all metas and lock them.
     *
     * @return void
     */
    public function boot()
    {
        TypeManager::setType('uuid')->setValue('migration', 'binaryUuid');
    }
}
