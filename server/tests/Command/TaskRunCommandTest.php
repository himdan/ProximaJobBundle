<?php
/**
 * Created by PhpStorm.
 * User: chehimi
 * Date: 16/07/22
 * Time: 06:51 م
 */

namespace Proxima\JobBundle\Tests\Command;


use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Proxima\JobBundle\Command\TaskRunCommand;
use Proxima\JobBundle\Discovery\TaskNotFoundException;
use Proxima\JobBundle\Discovery\TaskRunner;
use Proxima\JobBundle\IO\SubjectResolver;
use Proxima\JobBundle\Tests\Dags\TestDag;
use Psr\Log\LoggerInterface;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Exception\ServiceNotFoundException;
use Symfony\Component\Serializer\SerializerInterface;


class TaskRunCommandTest extends TestCase
{

    /** @var CommandTester */
    private $commandTester;
    /**
     * @var TaskRunner
     */
    private $taskResolver;
    /**
     * @var ContainerInterface| MockObject $container
     */
    private $container;

    protected function setUp(): void
    {

        $this->container = $this->getMockBuilder(ContainerInterface::class)
            ->disableOriginalConstructor()
            ->getMock();
        $logger = $this->createMock(LoggerInterface::class);
        $argsResolver = $this->createMock(SubjectResolver::class);
        $argsResolver->setLogger($logger);

        $this->taskResolver = new TaskRunner($this->container);
        $application = new Application();
        $application->add(new TaskRunCommand($this->taskResolver, $argsResolver));
        $command = $application->find('proxima_job:task_run');
        $this->commandTester = new CommandTester($command);
    }

    protected function mockDag(string $dag)
    {
        return $this
            ->getMockBuilder($dag)
            ->disableOriginalConstructor()
            ->getMock();
    }

    protected function tearDown(): void
    {
        $this->taskResolver = null;
        $this->commandTester = null;
    }

    public function testExecute()
    {

        $dag = TestDag::class;
        $task = 'task_1';
        $this->container
            ->method('get')
            ->with($dag)
            ->willReturn($this->mockDag($dag));

        $this
            ->container
            ->method('has')
            ->with($dag)
            ->willReturn(true);
        $this->commandTester->execute(['--dag' => $dag, '--task' => $task, '--args' => '{}']);
        $this->assertEquals(trim($this->commandTester->getDisplay()), trim($this->commandTester->getDisplay()));
    }

    public function testExecuteShouldThrowExceptionForTaskNotFound()
    {
        $dag = TestDag::class;
        $task = 'task_5';
        $this->container
            ->method('get')
            ->with($dag)
            ->willReturn($this->mockDag($dag));

        $this
            ->container
            ->method('has')
            ->with($dag)
            ->willReturn(true);

        $this->expectException(TaskNotFoundException::class);
        $this->commandTester->execute(['--dag' => $dag, '--task' => $task, '--args' => '{}']);
    }


    public function testExecuteShouldThrowExceptionForServiceNotFound()
    {
        $dag = 'Proxima\JobBundle\Tests\Dags\TestDags';
        $task = 'task_5';
        $this->container
            ->method('get')
            ->with($dag)
            ->willReturn($this->mockDag($dag));

        $this
            ->container
            ->method('has')
            ->with($dag)
            ->willReturn(false);

        $this->expectException(ServiceNotFoundException::class);
        $this->commandTester->execute(['--dag' => $dag, '--task' => $task, '--args' => '{}']);
    }
}