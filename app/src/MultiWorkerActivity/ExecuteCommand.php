<?php

/**
 * This file is part of Temporal package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Temporal\Samples\MultiWorkerActivity;

use Carbon\CarbonInterval;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Temporal\Client\WorkflowOptions;
use Temporal\SampleUtils\Command;

class ExecuteCommand extends Command
{
    protected const NAME = 'multi-worker-activity';
    protected const DESCRIPTION = 'Execute MultiWorkerActivity\MultiWorkerWorkflow';

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $workflow = $this->workflowClient->newWorkflowStub(
            MultiWorkerWorkflowInterface::class,
            WorkflowOptions::new()->withWorkflowExecutionTimeout(CarbonInterval::minute(5))
        );

        $output->writeln("Starting <comment>MultiWorkerWorkflow</comment>... ");

        // Start a workflow execution. Usually this is done from another program.
        // Uses task queue from the MultiWorkerWorkflow @WorkflowMethod annotation.
        $run = $this->workflowClient->start($workflow, 'Antony');

        $output->writeln(
            sprintf(
                'Started: WorkflowID=<fg=magenta>%s</fg=magenta>, RunID=<fg=magenta>%s</fg=magenta>',
                $run->getExecution()->getID(),
                $run->getExecution()->getRunID(),
            )
        );

        // getResult waits for workflow to complete
        $output->writeln(sprintf("Result:\n<info>%s</info>", $run->getResult()));

        return self::SUCCESS;
    }
}