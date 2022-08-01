<?php
/**
 * Created by PhpStorm.
 * User: chehimi
 * Date: 18/07/22
 * Time: 11:08 م
 */

namespace Proxima\JobBundle\Runner;

use Doctrine\ORM\EntityManagerInterface;
use Proxima\JobBundle\Entity\Dag;
use Proxima\JobBundle\Entity\DagInstance;
use Proxima\JobBundle\Entity\State;
use Proxima\JobBundle\Entity\Task;
use Proxima\JobBundle\Entity\TaskInstance;
use Symfony\Component\DependencyInjection\ContainerInterface;

class DagInstanceManager
{
    /**
     * @var EntityManagerInterface $entityManager
     */
    private $entityManager;
    /**
     * @var ContainerInterface $container
     */
    private $container;

    /**
     * DagInstanceManager constructor.
     * @param EntityManagerInterface $entityManager
     * @param ContainerInterface $container
     */
    public function __construct(EntityManagerInterface $entityManager, ContainerInterface $container)
    {
        $this->entityManager = $entityManager;
        $this->container = $container;
    }


    public function makeDagInstance(Dag $dag)
    {
        $dagInstance = new DagInstance();
        $dagInstance->setDag($dag);
        $dagInstance->setStatus(State::REGISTER);
        $this->makeTaskInstances($dag, $dagInstance);
        $this->entityManager->persist($dagInstance);
        $this->entityManager->flush();
        return $dagInstance;
    }

    private function makeTaskInstances(Dag $dag, DagInstance $dagInstance)
    {
        /**
         * @var Task $task
         */
        foreach ($dag->getTasks() as $task) {
            $taskInstance = new TaskInstance($dagInstance);
            $taskInstance->setTask($task);

            $taskInstance->setStatus(State::REGISTER);
            $this->entityManager->persist($taskInstance);

        }
    }
}