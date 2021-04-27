<?php

/**
 * This file is part of Temporal package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Temporal\Samples\LongRunningActivity;

use Carbon\CarbonInterval;
use Temporal\Activity\ActivityOptions;
use Temporal\Workflow;

class LongRunningWorkflow implements LongRunningWorkflowInterface
{
    private $greetingActivity;

    public function __construct()
    {
        /**
         * Activity stub implements activity interface and proxies calls to it to Temporal activity
         * invocations. Because activities are reentrant, only a single stub can be used for multiple
         * activity invocations.
         */
        $this->longRunningActivity = Workflow::newActivityStub(
            LongRunningActivity::class,
            ActivityOptions::new()->withStartToCloseTimeout(CarbonInterval::seconds(200))
        );
    }

    public function execute(string $name): \Generator
    {
        // This is a blocking call that returns only after the activity has completed.
        return yield $this->longRunningActivity->composeLongRunning('Hello', $name);
    }
}