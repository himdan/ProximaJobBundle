<?php
/**
 * Created by PhpStorm.
 * User: chehimi
 * Date: 16/07/22
 * Time: 05:45 م
 */

namespace Proxima\JobBundle\Message;


class TaskMessage
{

    /**
     * @var ?string $args
     */
    private $args;
    /**
     * @var ?string
     */
    private $dag;
    /**
     * @var ?string
     */
    private $task;
    /**
     * @var ?string
     */
    private $output;

    const COMMAND = 'proxima_job:task_run';

    /**
     * TaskMessage constructor.
     * @param $dag
     * @param $task
     * @param $args
     */
    public function __construct($dag, $task, $args)
    {
        $this->args = $args;
        $this->dag = $dag;
        $this->task = $task;
    }


    public function asProcess()
    {
        return [
            'php',
            'bin/console',
            self::COMMAND,
            "--dag",
            sprintf("%s", $this->getDag()),
            "--task",
            sprintf("%s", $this->getTask()),
            "--args",
            sprintf("%s", $this->getArgs())

        ];

    }

    /**
     * @return mixed
     */
    public function getArgs()
    {
        return $this->args;
    }

    /**
     * @return mixed
     */
    public function getDag()
    {
        return $this->dag;
    }

    /**
     * @return mixed
     */
    public function getTask()
    {
        return $this->task;
    }

    /**
     * @return mixed
     */
    public function getOutput()
    {
        return $this->output;
    }

    /**
     * @param mixed $output
     */
    public function setOutput($output): void
    {
        $this->output = $output;
    }






}