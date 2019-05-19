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

use Ramsey\Uuid as UuidGenerator;
use Laramore\Type;

class Uuid extends Field
{
    protected $type = Type::UUID;
    protected $hasDefault = false;

    public function castValue($model, $value)
    {
        return is_null($value) ? $value : (string) $value;
    }

    public function generateUuid()
    {
        return $this->castValue(UuidGenerator::uuid5());
    }

    public function getDefault()
    {
        if ($this->hasDefault) {
            return $this->generateUuid();
        } else {
            return $this->default;
        }
    }

    public function hasProperty(string $key): bool
    {
        if ($key === 'default' || $this->hasDefault) {
            return true;
        }

        return parent::hasProperty($key);
    }
}
