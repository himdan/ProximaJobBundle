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
     * @var string $command
     */
    private $command;
    /**
     * @var array $args
     */
    private $args;
    /**
     * @var array $options ;
     */
    private $options;

    /**
     * TaskMessage constructor.
     * @param string $command
     * @param array $args
     * @param array $options
     */
    public function __construct(string $command="proxima:task_run", array $args = [], array $options = [])
    {
        $this->command = $command;
        $this->args = $args;
        $this->options = $options;
    }

    /**
     * @return string
     */
    public function getCommand(): string
    {
        return $this->command;
    }

    /**
     * @return array
     */
    public function getArgs(): array
    {
        return $this->args;
    }

    /**
     * @return array
     */
    public function getOptions(): array
    {
        return $this->options;
    }


    public function asCommand()
    {
        return array_merge([
            'command' => $this->getCommand()
        ], $this->getOptions(), $this->getArgs());
    }


}