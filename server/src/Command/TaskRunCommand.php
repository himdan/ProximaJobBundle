<?php
/**
 * Created by PhpStorm.
 * User: chehimi
 * Date: 16/07/22
 * Time: 06:21 م
 */

namespace Proxima\JobBundle\Command;

use Proxima\JobBundle\Discovery\TaskRunner;
use Proxima\JobBundle\IO\CommandArg;
use Proxima\JobBundle\IO\SubjectResolver;
use Proxima\JobBundle\Message\TaskMessage;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class TaskRunCommand extends Command
{

    /**
     * @var TaskRunner $taskResolver
     */
    private $taskResolver;
    /**
     * @var SubjectResolver $subjectResolver
     */
    private $subjectResolver;


    public function __construct(TaskRunner $taskResolver, SubjectResolver $subjectResolver)
    {
        parent::__construct(TaskMessage::COMMAND);
        $this->taskResolver = $taskResolver;
        $this->subjectResolver = $subjectResolver;
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
        $dag = $input->getOption('dag');
        $task = $input->getOption('task');
        $args = @json_decode($input->getOption('args'));
        $args = is_array($args) ? $args : [];
        $this->denormalizeArgs($args);
        $cb = $this->taskResolver->resolve($dag, $task);
        $cb($args);
        return Command::SUCCESS;
    }

    private function denormalizeArgs(array &$args)
    {
        $cloneArgs = (new \ArrayObject($args))->getArrayCopy();
        foreach ($cloneArgs as $var => $value) {
            if (false !== ($resolved = $this->subjectResolver->resolveArgAs(
                    CommandArg::class,
                    $var,
                    $value
                ))) {
                $args[$var] = $resolved;
            }

        }

    }
}