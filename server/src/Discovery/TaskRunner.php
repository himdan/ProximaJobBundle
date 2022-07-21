<?php
/**
 * Created by PhpStorm.
 * User: chehimi
 * Date: 16/07/22
 * Time: 06:38 م
 */

namespace Proxima\JobBundle\Discovery;


use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Exception\ServiceNotFoundException;

class TaskRunner
{
    /**
     * @var ContainerInterface $container
     */
    private $container;

    /**
     * TaskResolver constructor.
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }


    public function resolve(string $dag, string $task)
    {
        if (!$this->container->has($dag)) {
            throw new ServiceNotFoundException($dag);
        }
        $fn = function ($args) use ($dag, $task) {
            if (!method_exists($this->container->get($dag), $task)) {
                throw new TaskNotFoundException(sprintf('%s is not defined in %s', $task, $dag));
            }
            return call_user_func([$this->container->get($dag), $task], $args);
        };

        return $fn;
    }
}