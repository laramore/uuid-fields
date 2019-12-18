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
use Laramore\Facades\Rules;

class Uuid extends AttributeField
{
    /**
     * Dry the value in a simple format.
     *
     * @param  mixed $value
     * @return mixed
     */
    public function dry($value)
    {
        $value = $this->getOwner()->transformFieldAttribute($this, $value);

        return $value->getBytes();
    }

    /**
     * Cast the value in the correct format.
     *
     * @param  mixed $value
     * @return mixed
     */
    public function cast($value)
    {
        $value = $this->getOwner()->transformFieldAttribute($this, $value);

        return $value;
    }

    /**
     * Transform the value to be used as a correct format.
     *
     * @param  mixed $value
     * @return mixed
     */
    public function transform($value)
    {
        if (($value instanceof UuidGenerator)) {
            return $value;
        }

        if (\is_string($value)) {
            try {
                return UuidGenerator::fromString($value);
            } catch (InvalidUuidStringException $e) {
                return UuidGenerator::fromBytes($value);
            }
        }

        throw new \Exception('The given value is not an uuid');
    }

    /**
     * Serialize the value for outputs.
     *
     * @param  mixed $value
     * @return mixed
     */
    public function serialize($value)
    {
        return (string) $value;
    }

    /**
     * Return a new generated uuid.
     *
     * @return string
     */
    public function generate(): string
    {
        return $this->getOwner()->castFieldAttribute($this, UuidGenerator::uuid4());
    }

    /**
     * Indicate if this has a default value.
     *
     * @return boolean
     */
    public function hasDefault(): bool
    {
        return (isset($this->default) || $this->hasRule(Rules::autoGenerate()));
    }

    /**
     * Return the default value.
     *
     * @return void
     */
    public function getDefault()
    {
        if ($this->hasRule(Rules::autoGenerate())) {
            return $this->generate();
        }

        return $this->default;
    }

    /**
     * As this package can be used with laramore/migrations, 
     * it is required not to generate a default field if the value is auto generated.
     *
     * @return array
     */
    public function getMigrationPropertyKeys(): array
    {
        $keys = $this->getType()->getMigrationPropertyKeys();

        if ($this->hasRule(Rules::autoGenerate()) && !\is_null($index = \array_search('default', $keys))) {
            unset($keys[$index]);
        }

        return $keys;
    }
}
