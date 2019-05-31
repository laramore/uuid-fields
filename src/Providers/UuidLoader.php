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
use Illuminate\Database\Schema\Grammars\{
    Grammar, MySqlGrammar
};
use Laramore\Facades\{
    TypeManager, GrammarObservableManager
};

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
        }

        $this->addMigrationFields();
    }

    /**
     * Add the migration field 'binaryUuid'.
     *
     * @return void
     */
    protected function addMigrationFields()
    {
        // For all grammars, the uuid is already a binary or a specific uuid type.
        $observable = GrammarObservableManager::getObservableHandler(Grammar::class);
        $observable->createObserver($this->migrationUuid, $this->migrationUuid, function ($column) {
            return $this->typeUuid($column);
        });

        // For only the Mysql grammar, the uuid a 16 length string.
        // So, in order to optimize it, we create a new type: a binary one.
        // It is programatically converted by the Uuid field:
        // Binary (for the database) <=> String (for all PHP interactions)
        $observable = GrammarObservableManager::getObservableHandler(MySqlGrammar::class);
        $observable->createObserver($this->migrationUuid, $this->migrationUuid, function ($column) {
            return 'binary(16)';
        });
    }
}
