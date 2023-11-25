<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class StatusAPI extends Enum
{
    const SUCCESS = 'success';
    const ERROR = 'error';
    const NOT_FOUND = 'not found';
    const UNAUTHORIZED = 'unauthorized';
    const FORBIDDEN = 'forbidden';
    const SERVER_ERROR = 'server error';
}
