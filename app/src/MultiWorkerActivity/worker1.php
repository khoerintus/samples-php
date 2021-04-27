<?php

/**
 * This file is part of Temporal package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

use Temporal\SampleUtils\DeclarationLocator;
use Temporal\WorkerFactory;
use Temporal\Samples\FileProcessing;
use Temporal\Samples\MultiWorkerActivity\MultiWorkerActivity;
use Temporal\Samples\MultiWorkerActivity\MultiWorkerWorkflow;
use Temporal\Worker\WorkerOptions;

ini_set('display_errors', 'stderr');
include "../../vendor/autoload.php";

// finds all available workflows, activity types and commands in a given directory
$declarations = DeclarationLocator::create(__DIR__);

// factory initiates and runs task queue specific activity and workflow workers
$factory = WorkerFactory::create();

// Worker that listens on a task queue and hosts both workflow and activity implementations.
// $worker = $factory->newWorker('default', WorkerOptions::new()->withMaxConcurrentActivityTaskPollers(3)->withMaxConcurrentWorkflowTaskPollers(1));
$worker = $factory->newWorker();


// foreach ($declarations->getWorkflowTypes() as $workflowType) {
//     // Workflows are stateful. So you need a type to create instances.
//     $worker->registerWorkflowTypes($workflowType);
// }

// foreach ($declarations->getActivityTypes() as $activityType) {
//     // Activities are stateless and thread safe. So a shared instance is used.
//     $worker->registerActivityImplementations(new $activityType());
// }
$worker->registerWorkflowTypes(MultiWorkerWorkflow::class);
$worker->registerActivityImplementations(new MultiWorkerActivity());


// start primary loop
$factory->run();
