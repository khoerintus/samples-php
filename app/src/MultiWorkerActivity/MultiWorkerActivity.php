<?php

/**
 * This file is part of Temporal package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Temporal\Samples\MultiWorkerActivity;

use Spiral\RoadRunner\Logger;
use Temporal\Activity;

class MultiWorkerActivity implements MultiWorkerActivityInterface
{
    public $logger;

    public function __construct()
    {
        $this->logger = new Logger();
    }

    public function composeMultiWorker(string $greeting, string $name): string
    {
        for ($i=0; $i < 50; $i++) {
            sleep(1);
            // file_put_contents('php://stderr', sprintf('[%s] %s', "INFO", "Sleeping ".$i));
            $this->logger->info('Sleeping '.$i);
        }

        return $greeting . ' ' . $name;
    }
}
