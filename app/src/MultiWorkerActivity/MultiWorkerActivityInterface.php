<?php

/**
 * This file is part of Temporal package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Temporal\Samples\MultiWorkerActivity;

use Temporal\Activity\ActivityInterface;
use Temporal\Activity\ActivityMethod;

#[ActivityInterface(prefix: 'MultiWorkerActivity.')]
interface MultiWorkerActivityInterface
{
    #[ActivityMethod(name: "ComposeMultiWorker")]
    public function composeMultiWorker(
        string $greeting,
        string $name
    ): string;
}