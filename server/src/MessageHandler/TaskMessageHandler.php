<?php
/**
 * Created by PhpStorm.
 * User: chehimi
 * Date: 16/07/22
 * Time: 05:50 م
 */

namespace Proxima\JobBundle\MessageHandler;


use Proxima\JobBundle\Message\TaskMessage;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\BufferedOutput;
use Symfony\Component\HttpKernel\KernelInterface;

abstract class TaskMessageHandler
{
    /**
     * @var KernelInterface $kernel
     */
    private $kernel;

    /**
     * TaskMessageHandler constructor.
     * @param KernelInterface $kernel
     */
    public function __construct(KernelInterface $kernel)
    {
        $this->kernel = $kernel;
    }


    public function __invoke(TaskMessage $taskMessage)
    {
        $application = new Application();
        $input = new ArrayInput($taskMessage->asCommand());
        $output = new BufferedOutput();
        $code = $application->run($input, $output);
        $content = $output->fetch();
        if ($code !== 0) {
            $this->triggerFailure($taskMessage, $content);
            return 0;
        }

        $this->triggerSuccess($taskMessage, $content);
    }


     protected function triggerFailure($taskMessage, $content){

     }

     protected function triggerSuccess($taskMessage, $content){

     }
}