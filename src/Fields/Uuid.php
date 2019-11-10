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

use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid as UuidGenerator;
use Ramsey\Uuid\Exception\InvalidUuidStringException;
use Laramore\Eloquent\ModelEvent;
use Laramore\Elements\Type;
use Rules, Types;

class Uuid extends Field
{
    /**
     * Dry the value in a simple format.
     *
     * @param  mixed $value
     * @return mixed
     */
    public function dry($value)
    {
        if (!($value instanceof UuidGenerator)) {
            $value = $this->getOwner()->transformFieldAttribute($this, $value);
        }

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
        if (!($value instanceof UuidGenerator)) {
            $value = $this->getOwner()->transformFieldAttribute($this, $value);
        }

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
        if (\is_string($value)) {
            try {
                return UuidGenerator::fromString($value);
            } catch (InvalidUuidStringException $e) {
                try {
                    return UuidGenerator::fromBytes($value);
                } catch (InvalidUuidStringException $e) {
                    // Just throw.
                }
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
     * Add an observe to generate a new uuid for the attribute if it not exists.
     *
     * @return void
     */
    protected function locking()
    {
        parent::locking();

        if (Rules::autoGenerate()) {
            $this->setGeneration();
        }
    }

    /**
     * Define the auto generation if asked.
     *
     * @return void
     */
    protected function setGeneration()
    {
        $this->getMeta()->getModelEventHandler()->add(new ModelEvent('generate_uuid_for_'.$this->name, function (Model $model) {
            if (is_null($model->{$this->name})) {
                $model->{$this->name} = $this->generate();
            }
        }, ModelEvent::MEDIUM_PRIORITY, 'saving'));
    }
}
