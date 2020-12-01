<?php
/**
 * Define an uuid field.
 *
 * @author Samy Nastuzzi <samy@nastuzzi.fr>
 *
 * @copyright Copyright (c) 2019
 * @license MIT
 */

namespace Laramore\Fields;

use Laramore\Contracts\Field\Constraint\PrimaryField;
use Laramore\Fields\Constraint\PrimaryConstraintHandler;

class PrimaryUuid extends Uuid implements PrimaryField
{
    /**
     * Create a Constraint handler for this meta.
     *
     * @return void
     */
    protected function setConstraintHandler()
    {
        $this->constraintHandler = new PrimaryConstraintHandler($this);
    }

    /**
     * Return the relation handler for this meta.
     *
     * @return PrimaryConstraintHandler
     */
    public function getConstraintHandler(): PrimaryConstraintHandler
    {
        return parent::getConstraintHandler();
    }

    /**
     * Reet the value for the field.
     *
     * @param LaramoreModel|array|\ArrayAccess $model
     * @return mixed
     */
    public function reset($model)
    {
        if ($this->hasDefault()) {
            return $this->set($model, $this->getDefault());
        }

        return $this->set($model, $this->generate());
    }
}
