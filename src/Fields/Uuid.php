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
use Types;

class Uuid extends Field
{
    protected $autoGenerate = false;

    /**
     * Cast the field value in the right type.
     *
     * @param  mixed $model
     * @param  mixed $value
     * @return string
     */
    public function dry($value)
    {
        if (!($value instanceof UuidGenerator)) {
            $value = $this->getOwner()->transformFieldAttribute($this, $value);
        }

        return $value->getBytes();
    }

    /**
     * Cast the field value in the right type.
     *
     * @param  mixed $model
     * @param  mixed $value
     * @return string
     */
    public function cast($value)
    {
        if (!($value instanceof UuidGenerator)) {
            $value = $this->getOwner()->transformFieldAttribute($this, $value);
        }

        return $value;
    }

    public function transform($value)
    {
        if (is_string($value)) {
            try {
                return UuidGenerator::fromString($value);
            } catch (InvalidUuidStringException $e) {
                try {
                    return UuidGenerator::fromBytes($value);
                } catch (InvalidUuidStringException $e) {}
            }
        }

        throw new \Exception('The given value is not an uuid');
    }

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

        if ($this->autoGenerate) {
            $this->setGeneration();
        }
    }

    protected function setGeneration()
    {
        $this->getMeta()->getModelEventHandler()->add(new ModelEvent('generate_uuid_for_'.$this->name, function (Model $model) {
            if (is_null($model->{$this->name})) {
                $model->{$this->name} = $this->generate();
            }
        }, ModelEvent::MEDIUM_PRIORITY, 'saving'));
    }
}
