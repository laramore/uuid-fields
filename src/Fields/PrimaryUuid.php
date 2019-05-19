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

use Laramore\Interfaces\IsAPrimaryField;

class PrimaryUuid extends Uuid implements IsAPrimaryField
{
    protected $autoGenerate = true;
}
