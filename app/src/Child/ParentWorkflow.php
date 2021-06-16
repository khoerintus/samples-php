<?php

/**
 * This file is part of Temporal package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Temporal\Samples\Child;

use Spiral\RoadRunner\Logger;
use Temporal\Common\RetryOptions;
use Temporal\Workflow;
use Temporal\Workflow\ChildWorkflowOptions;

/**
 * Demonstrates a child workflow. Requires a local instance of the Temporal server to be running.
 */
class ParentWorkflow implements ParentWorkflowInterface
{
    public $logger;

    public function __construct()
    {
        $this->logger = new Logger();
    }

    public function greet(string $name)
    {
        $child = Workflow::newChildWorkflowStub(
            ChildWorkflow::class,
            ChildWorkflowOptions::new()
                ->withWorkflowId('FixedWorkflowID')
                ->withRetryOptions(
                    RetryOptions::new()
                        ->withMaximumAttempts(3)
                )
        );

        // This is a non blocking call that returns immediately.
        // Use yield $child->greet(name) to call synchronously.
        try {
            $childGreet = $child->greet($name);
        } catch (\Throwable $e) {
            $this->logger->error($e->getMessage());
            $childGreet = "";
        }

        // Do something else here.

        return 'Hello ' . $name . ' from parent; ' . yield $childGreet;
    }
}
