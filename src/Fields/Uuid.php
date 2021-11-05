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

use Illuminate\Support\Arr;
use Ramsey\Uuid\Uuid as UuidGenerator;
use Ramsey\Uuid\UuidInterface;
use Ramsey\Uuid\Exception\InvalidUuidStringException;
use Laramore\Exceptions\FieldException;

class Uuid extends BaseAttribute
{
    /**
     * Version used for generation.
     *
     * @var integer
     */
    protected $version;

    /**
     * Version 1 (time-based) UUID object constant identifier.
     *
     * @var integer
     */
    const VERSION_1 = UuidGenerator::UUID_TYPE_TIME;

    /**
     * Version 2 (DCE Security) UUID
     *
     * @var integer
     */
    const VERSION_2 = UuidGenerator::UUID_TYPE_DCE_SECURITY;

    /**
     * Version 3 (name-based and hashed with MD5) UUID object constant identifier.
     *
     * @var integer
     */
    const VERSION_3 = UuidGenerator::UUID_TYPE_HASH_MD5;

    /**
     * Version 4 (random) UUID object constant identifier.
     *
     * @var integer
     */
    const VERSION_4 = UuidGenerator::UUID_TYPE_RANDOM;

    /**
     * Version 5 (name-based and hashed with SHA1) UUID object constant identifier.
     *
     * @var integer
     */
    const VERSION_5 = UuidGenerator::UUID_TYPE_HASH_SHA1;

    /**
     * Version 6 (ordered-time) UUID
     *
     * @var integer
     */
    const VERSION_6 = UuidGenerator::UUID_TYPE_PEABODY;

    /**
     * Dry the value in a simple format.
     *
     * @param  mixed $value
     * @return mixed
     */
    public function dry($value)
    {
        if ($value instanceof UuidGenerator) {
            return $value->getBytes();
        }

        return $value;
    }

    /**
     * Hydrate the value in the correct format.
     *
     * @param  mixed $value
     * @return mixed
     */
    public function hydrate($value)
    {
        if (\is_null($value)) {
            return $value;
        }

        if (\is_string($value) || $value instanceof UuidInterface) {
            try {
                try {
                    return UuidGenerator::fromString($value);
                } catch (InvalidUuidStringException $_) {
                    return UuidGenerator::fromBytes($value);
                }
            } catch (\Exception $e) {
                throw new FieldException($this, $e->getMessage());
            }
        }

        throw new FieldException($this, 'The given value is not an uuid');
    }

    /**
     * Cast the value in the correct format.
     *
     * @param  mixed $value
     * @return mixed
     */
    public function cast($value)
    {
        if (\is_null($value) || ($value instanceof UuidGenerator)) {
            return $value;
        }

        if (\is_string($value) || $value instanceof UuidInterface) {
            try {
                try {
                    return UuidGenerator::fromString($value);
                } catch (InvalidUuidStringException $_) {
                    return UuidGenerator::fromBytes($value);
                }
            } catch (\Exception $e) {
                throw new FieldException($this, $e->getMessage());
            }
        }

        throw new FieldException($this, 'The given value is not an uuid');
    }

    /**
     * Serialize the value for outputs.
     *
     * @param  mixed $value
     * @return mixed
     */
    public function serialize($value)
    {
        return is_null($value) ? null : (string) $value;
    }

    /**
     * Return a new generated uuid.
     *
     * @return \Ramsey\Uuid\UuidInterface
     */
    public function generate(): UuidInterface
    {
        $possibleConfig = $this->getFactoryConfig();
        $version = Arr::get($possibleConfig, 'formater', $this->version);
        $parameters = Arr::get($possibleConfig, 'parameters', []);

        return $this->cast(UuidGenerator::{'uuid'.$version}(...$parameters));
    }

    /**
     * Define default value as auto generated.
     *
     * @return self
     */
    public function autoGenerate()
    {
        $this->default([$this, 'generate']);

        return $this;
    }
}
