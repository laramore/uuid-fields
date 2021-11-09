<?php
/**
 * Laramore example session.
 *
 * @author Samy Nastuzzi <samy@nastuzzi.fr>
 *
 * @copyright Copyright (c) 2021
 * @license MIT
 */

namespace Laramore\Eloquent;

use Laramore\Fields\ManyToOneUuid;

class BaseSessionUuid extends BaseSession
{
    protected static $userFieldClass = ManyToOneUuid::class;
}
