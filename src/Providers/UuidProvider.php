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
use Laramore\Traits\Provider\MergesConfig;
use Laramore\Facades\{
    Type, GrammarType
};

class UuidProvider extends ServiceProvider
{
    use MergesConfig;

    /**
     * Prepare all configs and default options, types and fields.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__."/../../config/field.php", "field",
        );

        $this->mergeConfigFrom(
            __DIR__."/../../config/option.php", "option",
        );

        $this->mergeConfigFrom(
            __DIR__."/../../config/type.php", "type",
        );
    }

    /**
     * At booting, add migration fields.
     *
     * @return void
     */
    public function boot()
    {
         $this->addMigrationFields();
    }

    /**
     * Add the migration field 'binaryUuid'.
     *
     * @return void
     */
    protected function addMigrationFields()
    {
        $uuidType = Type::get('uuid')->getDefaultMigrationType();
        $primaryType = Type::get('primary_uuid')->getDefaultMigrationType();

        // For all grammars, the uuid is already a binary or a specific uuid type.
        $handler = GrammarType::getHandler(Grammar::class);
        $handler->create($uuidType, $uuidType, function ($column) {
            return $this->typeUuid($column);
        });

        // For all grammars, the uuid is already a binary or a specific uuid type.
        $handler = GrammarType::getHandler(Grammar::class);
        $handler->create($primaryType, $primaryType, function ($column) {
            return $this->typeUuid($column);
        });

        // For only the Mysql grammar, the uuid type is a 16 length string.
        // So, in order to optimize it, we create a new type: a binary one.
        // It is programatically converted by the Uuid field:
        // Binary (for the database) <=> String (for all PHP interactions).
        $handler = GrammarType::getHandler(MySqlGrammar::class);
        $handler->create($uuidType, $uuidType, function ($column) {
            return 'binary(16)';
        });
    }
}
