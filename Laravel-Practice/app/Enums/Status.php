<?php

namespace App\Enums;

use Rexlabs\Enum\Enum;

/**
 * The Status enum.
 *
 * @method static self IN_PROGRESS()
 * @method static self COMPLETE()
 * @method static self FAILED()
 */
class Status extends Enum
{
    const IN_PROGRESS = 1;
    const COMPLETE = 2;
    const FAILED = 3;

    /**
     * Retrieve a map of enum keys and values.
     *
     * @return array
     */
    public static function map() : array
    {
        return [
            static::IN_PROGRESS => 'In progress',
            static::COMPLETE => 'Complete',
            static::FAILED => 'Failed',
        ];
    }
}
