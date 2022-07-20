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
        $process->start();

        foreach ($process as $type => $data) {
            if ($process::OUT === $type) {
                echo "\nRead from stdout: ".$data;
                $taskMessage->setOutput($data);
            } else {
                // $process::ERR === $type
                echo "\nRead from stderr: ".$data;
            }
        }
    }
}