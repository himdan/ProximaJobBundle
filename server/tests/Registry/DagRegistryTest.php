<?php
/**
 * Created by PhpStorm.
 * User: chehimi
 * Date: 16/07/22
 * Time: 03:19 م
 */

namespace Proxima\JobBundle\Tests\Registry;


use Doctrine\ORM\EntityManagerInterface;
use PHPUnit\Framework\TestCase;
use Proxima\JobBundle\Entity\Task as TaskEntity;
use Proxima\JobBundle\EntityManager\RunTimeEntityManager;
use Proxima\JobBundle\Registry\DagConfigurator;
use Proxima\JobBundle\Registry\DagRegistry;
use Proxima\JobBundle\Repository\TaskRepository;

class DagRegistryTest extends TestCase
{
    private function mockConfigurator()
    {
        $mock = $this->createMock(DagConfigurator::class);
        $mock
            ->method('getDagProjectDirectory')
            ->willReturn(sprintf('%s/%s', __DIR__, '../dags'));
        $mock
            ->method('getDagNamespace')
            ->willReturn('Proxima\JobBundle\Tests\Dags');
        return $mock;
    }

    private function mockEm()
    {
        $mock = $this->createMock(RunTimeEntityManager::class);
        $mock
            ->method('getRepository')
            ->willReturn($this->mockTaskRepository());
        return $mock;
    }

    private function mockTaskRepository()
    {
        $mock = $this->createMock(TaskRepository::class);
        return $mock;
    }

    public function testRegister()
    {
        $mock = $this->mockConfigurator();
        $dagRegistry = new DagRegistry($mock);
        $dagRegistry->setEm($this->mockEm());
        $dagRegistry->register();
        $this->assertInstanceOf(DagRegistry::class, $dagRegistry);
    }
}