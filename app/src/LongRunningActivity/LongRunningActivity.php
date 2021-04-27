<?php

/**
 * This file is part of Temporal package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Temporal\Samples\LongRunningActivity;

use Spiral\RoadRunner\Logger;
use Temporal\Activity;

class LongRunningActivity implements LongRunningActivityInterface
{
    private $logger;

    public function __construct()
    {
        $this->logger = new Logger;
    }

    public function composeLongRunning(string $greeting, string $name): string
    {
        for ($i=0; $i < 20; $i++) {
            sleep(1);
            $this->logger->info("Sleeping ".$i);
        }

        return $greeting . ' ' . $name;
    }
}
