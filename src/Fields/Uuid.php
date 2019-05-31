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
use Laramore\Facades\TypeManager;
use Laramore\Observers\ModelObserver;
use Laramore\Type;

class Uuid extends Field
{
    protected $autoGenerate = false;

    /**
     * Return the field type.
     *
     * @return Type
     */
    public function getType(): Type
    {
        return TypeManager::uuid();
    }

    /**
     * Cast the field value in the right type.
     *
     * @param  mixed $model
     * @param  mixed $value
     * @return string
     */
    public function castValue($model, $value)
    {
        return is_null($value) ? $value : (string) $value;
    }

    /**
     * Return the field value to set in the model.
     *
     * @param  mixed $model
     * @param  mixed $value
     * @return string
     */
    public function setValue($model, $value)
    {
        if (!($value instanceof UuidGenerator)) {
            try {
                $value = UuidGenerator::fromString($this->castValue($model, $value));
            } catch (InvalidUuidStringException $e) {
                try {
                    $value = UuidGenerator::fromBytes($value);
                } catch (InvalidUuidStringException $e) {
                    throw new \Exception('The given value is not an uuid');
                }
            }
        }

        return $value->getBytes();
    }

    /**
     * Return the field value to set in the model.
     *
     * @param  mixed $model
     * @param  mixed $value
     * @return string
     */
    public function getValue($model, $value)
    {
        if (!($value instanceof UuidGenerator)) {
            try {
                $value = UuidGenerator::fromBytes($value);
            } catch (InvalidUuidStringException $e) {
                throw new \Exception('The given value is not an uuid');
            }
        }

        return $this->castValue($model, $value);
    }

    /**
     * Return a new generated uuid.
     *
     * @return string
     */
    public function generateUuid(): string
    {
        return $this->castValue(null, UuidGenerator::uuid4());
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
            $this->addObserver(new ModelObserver('generate_uuid_for_'.$this->name, function (Model $model) {
                if (is_null($model->{$this->name})) {
                    $model->{$this->name} = $this->generateUuid();
                }
            }, ModelObserver::MEDIUM_PRIORITY, 'saving'));
        }
    }
}
