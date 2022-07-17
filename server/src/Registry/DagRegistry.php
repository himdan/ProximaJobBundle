<?php
/**
 * Created by PhpStorm.
 * User: chehimi
 * Date: 16/07/22
 * Time: 10:18 ص
 */

namespace Proxima\JobBundle\Registry;


use Proxima\JobBundle\Attributes\Dag;
use Proxima\JobBundle\Attributes\Task;
use Psr\Log\LoggerInterface;
use Psr\Log\LoggerAwareInterface;
use Symfony\Component\Finder\Finder;

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
     * DagRegistry constructor.
     * @param DagKernelInterface $kernel
     */
    public function __construct(DagKernelInterface $kernel)
    {
        $this->kernel = $kernel;
    }


    public function register()
    {
        $projectDir = $this->kernel->getDagProjectDirectory();
        $namespace = $this->kernel->getDagNamespace();
        $finder = new Finder();
        $finder->files()->in($projectDir)->name('*.php');
        foreach ($finder as $file) {
            $className = rtrim($namespace, '\\') . '\\' . $file->getFilenameWithoutExtension();
            if (class_exists($className)) {
                $this->registerSingleDagInstance($className);
            }
        }

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

                if (!$method->hasReturnType() || $method->getReturnType()->getName() !== TaskRunInterface::class) {
                    continue;
                }
                $attributes = $method->getAttributes(Task::class);
                foreach ($attributes as $attribute) {
                    /*
                     * @var Task $taskInstance
                     */
                    $taskInstance = $attribute->newInstance();

                    $this->compile($dagInstance, $taskInstance);

                }
            }
        }


    }

    private function compile(Dag $dag, Task $task)
    {
        echo "\n $dag $task \n";
    }
}