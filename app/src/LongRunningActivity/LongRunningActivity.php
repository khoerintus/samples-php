<?php

/**
 * This file is part of Temporal package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Temporal\Samples\LongRunningActivity;

use Temporal\Activity;

class LongRunningActivity implements LongRunningActivityInterface
{
    public function composeLongRunning(string $greeting, string $name): string
    {
        for($i=0; $i < 10000; $i++){
            sleep(1);
            file_put_contents('php://stderr', sprintf('[%s] %s', "INFO", "Sleeping ".$i));
        }

        return $greeting . ' ' . $name;
    }
}