<?php

declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static Videoactive()
 * @method static static VideoError()
 */
final class VideoStatus extends Enum
{
    const VideoError = 0;

    const Videoactive = 1;
}
