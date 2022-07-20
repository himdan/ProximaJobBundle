<?php
/**
 * Created by PhpStorm.
 * User: chehimi
 * Date: 16/07/22
 * Time: 06:21 م
 */

namespace Proxima\JobBundle\Command;

use Proxima\JobBundle\Discovery\TaskResolver;
use Proxima\JobBundle\Message\TaskMessage;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class TaskRunCommand extends Command
{

    /**
     * @var TaskResolver $taskResolver
     */
    private $taskResolver;

    public function __construct(TaskResolver $taskResolver)
    {
        parent::__construct(TaskMessage::COMMAND);
        $this->taskResolver = $taskResolver;
    }


    protected function configure()
    {
        $this
            ->setName(TaskMessage::COMMAND)
            ->addOption('dag', null, InputOption::VALUE_REQUIRED)
            ->addOption('task', null, InputOption::VALUE_REQUIRED)
            ->addOption('args', null, InputOption::VALUE_REQUIRED);
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {


        $output->writeln($input->getOption('dag'));
        $output->writeln($input->getOption('task'));
        $output->writeln($input->getOption('args'));
        $dag = $input->getOption('dag');
        $task = $input->getOption('task');
        $args = @json_decode($input->getOption('args'));
        $args = is_array($args) ? $args : [];
        $cb = $this->taskResolver->resolve($dag, $task);
        $cb($args);
        return Command::SUCCESS;
    }
}