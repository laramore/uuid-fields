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
use Laramore\Facades\Option;
use Laramore\Contracts\Eloquent\LaramoreModel;

class Uuid extends BaseAttribute
{
    /**
     * Dry the value in a simple format.
     *
     * @param  mixed $value
     * @return mixed
     */
    public function dry($value)
    {
        return $this->transform($value)->getBytes();
    }

    /**
     * Cast the value in the correct format.
     *
     * @param  mixed $value
     * @return mixed
     */
    public function cast($value)
    {
        return $this->transform($value);
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
            } catch (InvalidUuidStringException $_) {
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
        return $this->cast(UuidGenerator::uuid4());
    }

    /**
     * Reet the value for the field.
     *
     * @param  LaramoreModel $model
     * @return mixed
     */
    public function reset(LaramoreModel $model)
    {
        if ($this->hasDefault()) {
            $model->setAttributeValue($this->getNative(), $value = $this->getDefault());

            return $value;
        }

        if ($this->hasOption(Option::autoGenerate())) {
            $model->setAttributeValue($this->getNative(), $value = $this->generate());

            return $value;
        }

        $model->unsetAttribute($this->getNative());
    }

    /**
     * Check all properties and options before locking the field.
     *
     * @return void
     */
    public function checkOptions()
    {
        parent::checkOptions();

        if ($this->hasDefault() && $this->hasOption(Option::autoGenerate())) {
            throw new \LogicException("The field `{$this->getName()}` cannot have a default value and be auto generated");
        }
    }
}
