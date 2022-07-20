<?php
/**
 * Created by PhpStorm.
 * User: chehimi
 * Date: 16/07/22
 * Time: 05:50 م
 */

namespace Proxima\JobBundle\MessageHandler;


use Proxima\JobBundle\Message\TaskMessage;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Component\Process\Process;

class TaskMessageHandler implements MessageHandlerInterface
{


    public function __invoke(TaskMessage $taskMessage)
    {
        $process = new Process($taskMessage->asProcess());
        $process->run(function ($type, $buffer) use ($taskMessage) {
            echo sprintf('%s> %s %s', $type, $buffer, PHP_EOL);
            $taskMessage->setOutput($buffer);
        });

        $taskMessage->setStatus($process->isSuccessful()?TaskMessage::SUCCESS:TaskMessage::FAILED);
    }
}