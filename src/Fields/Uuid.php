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

use Ramsey\Uuid\Uuid as UuidGenerator;
use Ramsey\Uuid\Exception\InvalidUuidStringException;
use Laramore\Type;

class Uuid extends Field
{
    protected $type = Type::UUID;
    protected $generateByDefault = false;

    public function castValue($model, $value)
    {
        return is_null($value) ? $value : (string) $value;
    }

    public function setValue($model, $value)
    {
        if (!($value instanceof UuidGenerator)) {
            try {
                $value = UuidGenerator::fromString($value);
            } catch (InvalidUuidStringException $e) {
                throw new \Exception('The given value is not an uuid');
            }
        }

        return $this->castValue($model, $value);
    }

    public function generateUuid()
    {
        return $this->castValue(null, UuidGenerator::uuid4());
    }

    public function getDefault()
    {
        if ($this->generateByDefault) {
            return $this->generateUuid();
        } else {
            return $this->default;
        }
    }

    public function hasProperty(string $key): bool
    {
        if ($key === 'default' || $this->generateByDefault) {
            return true;
        }

        return parent::hasProperty($key);
    }
}
