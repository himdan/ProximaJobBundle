<?php
/**
 * Created by PhpStorm.
 * User: chehimi
 * Date: 17/07/22
 * Time: 10:57 ص
 */

namespace Proxima\JobBundle\Tests\MessageHandler;

use PHPUnit\Framework\MockObject\MockObject;
use Proxima\JobBundle\Message\TaskMessage;
use Proxima\JobBundle\MessageHandler\TaskMessageHandler;
use Proxima\JobBundle\Tests\Dags\TestDag;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Messenger\MessageBusInterface;

class TaskMessageHandlerTest extends WebTestCase
{
    /**
     * @var MessageBusInterface|MockObject $messageBus
     */
    private $messageBus;
    /**
     * @var TaskMessageHandler
     */
    private $messageHandler;
    /**
     * @var ContainerInterface| MockObject $container
     */
    private $container;

    protected function mockDag(string $dag)
    {
        return $this
            ->getMockBuilder($dag)
            ->disableOriginalConstructor()
            ->getMock();
    }

    private function mockContainer()
    {

        $this->container = $this->getMockBuilder(ContainerInterface::class)
            ->disableOriginalConstructor()
            ->getMock();
        $dag = TestDag::class;
        $this->container
            ->method('get')
            ->with($dag)
            ->willReturn($this->mockDag($dag));

        $this
            ->container
            ->method('has')
            ->with($dag)
            ->willReturn(true);
    }

    protected function setUp(): void
    {

        $this->mockContainer();

        $this->messageBus = $this
            ->getMockBuilder(MessageBusInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->messageHandler = new TaskMessageHandler();
    }

    protected function tearDown(): void
    {
        $this->messageHandler = null;
        $this->messageBus = null;
    }

    public function testInvoke()
    {


        $message = new TaskMessage(
            TestDag::class,
            'task_1',
            \json_encode([
                'a' => 10,
                'b' => 20
            ])
        );

        $handler = $this->messageHandler;
        $handler($message);
        $this->assertEquals($message->getStatus(), TaskMessage::SUCCESS);
    }

}