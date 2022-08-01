<?php
/**
 * Created by PhpStorm.
 * User: chehimi
 * Date: 16/07/22
 * Time: 10:18 ص
 */

namespace Proxima\JobBundle\Registry;

use Doctrine\ORM\EntityRepository;
use Proxima\JobBundle\Attributes\Dag;
use Proxima\JobBundle\Attributes\Task;
use Proxima\JobBundle\EntityManager\RunTimeEntityManager;
use Proxima\JobBundle\Repository\TaskRepository;
use Psr\Log\LoggerInterface;
use Psr\Log\LoggerAwareInterface;
use Symfony\Component\Finder\Finder;
use Proxima\JobBundle\Entity\Dag as DagEntity;
use Proxima\JobBundle\Entity\Task as TaskEntity;

class DagRegistry implements LoggerAwareInterface
{
    /**
     * @var DagKernelInterface $kernel
     */
    private $kernel;
    /**
     * @var LoggerInterface $logger
     */
    private $logger;
    /**
     * @var RunTimeEntityManager $em
     */
    private $em;

    /**
     * DagRegistry constructor.
     * @param DagKernelInterface $kernel
     */
    public function __construct(DagKernelInterface $kernel)
    {
        $this->kernel = $kernel;
    }

    /**
     * @param RunTimeEntityManager $em
     */
    public function setEm(RunTimeEntityManager $em): void
    {
        $this->em = $em;
    }


    public function register()
    {
        $projectDir = $this->kernel->getDagProjectDirectory();
        $namespace = $this->kernel->getDagNamespace();
        $finder = new Finder();
        $finder->files()->in($projectDir)->name('*.php');
        foreach ($finder as $file) {
            $className = rtrim($namespace, '\\') . '\\' . $file->getFilenameWithoutExtension();
            echo $className . PHP_EOL;
            if (class_exists($className)) {
                $this->registerSingleDagInstance($className);
            }
        }




        $this->em->flushAndPurge();

    }

    public function setLogger(LoggerInterface $logger): void
    {
        $this->logger = $logger;
    }


    private function registerSingleDagInstance(string $className): void
    {
        $reflectionClass = new \ReflectionClass($className);
        if (!$reflectionClass->implementsInterface(DagRunInterface::class)) {
            $this->logger->warning(sprintf('%s Must implement %s', $className, DagRunInterface::class));
            return;
        }
        $attributesClass = $reflectionClass->getAttributes(Dag::class);
        foreach ($attributesClass as $singleAttribute) {
            /**
             * @var Dag $dagInstance
             */
            $dagInstance = $singleAttribute->newInstance();
            foreach ($reflectionClass->getMethods() as $method) {

                $attributes = $method->getAttributes(Task::class);
                foreach ($attributes as $attribute) {
                    /*
                     * @var Task $taskInstance
                     */
                    $taskInstance = $attribute->newInstance();

                    $this->upsert($className, $dagInstance, $taskInstance);

                }
            }
        }


    }

    private function upsert(
        string $className,
        Dag $dag,
        Task $task)
    {

        echo $className . PHP_EOL;
        echo $task . PHP_EOL;
        $dagEntityInstance = $this->getOrCreateDag($dag, $className);
        $this->upsertTask($dagEntityInstance, $task);
        $this->em->persistAndStash($dagEntityInstance);

    }


    private function upsertTask(DagEntity $dag, Task $task)
    {
        /**
         * @var TaskRepository $taskRepository
         */
        $taskRepository = $this->em->getRepository(TaskEntity::class);
        $taskEntity = $taskRepository->findOneByDagClassNameAndTaskName(
            $dag->getClassName(),
            $task->name
        );
        if ($taskEntity instanceof TaskEntity) {
            $taskEntity->setWorkflow($task->workflow);
            return;
        }

        $taskEntity = new TaskEntity();
        $taskEntity->setDag($dag);
        $taskEntity->setName($task->name);
        $taskEntity->setWorkflow($task->workflow);
        $this->em->persistAndStash($taskEntity);

        $dag->addTask($taskEntity);

    }


    private function getOrCreateDag(Dag $dag, string $className): DagEntity
    {

        /**
         * @var  EntityRepository $dagEntityRepository
         */
        $dagEntityRepository = $this->em->getRepository(DagEntity::class);
        $dagEntityInstance = $dagEntityRepository->findOneBy(
            [
                'className' => $className
            ]
        );
        if ($dagEntityInstance instanceof DagEntity) {
            return $dagEntityInstance;
        }


        $dagEntityInstance = new DagEntity();
        $dagEntityInstance->setClassName($className);
        $this->em->persistAndStash($dagEntityInstance);
        return $dagEntityInstance;


    }
}