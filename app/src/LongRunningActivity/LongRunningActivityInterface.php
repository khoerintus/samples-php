<?php

/**
 * This file is part of Temporal package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Temporal\Samples\LongRunningActivity;

use Temporal\Activity\ActivityInterface;
use Temporal\Activity\ActivityMethod;

#[ActivityInterface(prefix: 'LongRunningActivity.')]
interface LongRunningActivityInterface
{
    #[ActivityMethod(name: "ComposeLongRunning")]
    public function composeLongRunning(
        string $greeting,
        string $name
    ): string;
}