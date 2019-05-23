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
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Schema\Grammars\{
	Grammar, MySqlGrammar
};
use Laramore\Facades\TypeManager;

class UuidLoader extends ServiceProvider
{
    protected $migrationUuid = 'binaryUuid';

    /**
     * Prepare all metas and lock them.
     *
     * @return void
     */
    public function boot()
    {
        $type = TypeManager::setType('uuid');

        if (TypeManager::hasValueName('migration')) {
            $type->setValue('migration', $this->migrationUuid);

            $this->addMigrationFields();
        }
    }

    /**
     * Add the migration field 'binaryUuid'.
     *
     * @return void
     */
    protected function addMigrationFields()
    {
        $name = $this->migrationUuid;

        Blueprint::macro($this->migrationUuid, function ($column) use ($name) {
            return $this->addColumn($name, $column);
        });

        Grammar::macro('type'.ucfirst($this->migrationUuid), function ($column) use ($name) {
            return $this->typeUuid($column);
        });

        MySqlGrammar::macro('type'.ucfirst($this->migrationUuid), function ($column) use ($name) {
            return 'binary(16)';
        });
    }
}
