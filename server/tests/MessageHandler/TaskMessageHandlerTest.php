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
use Symfony\Component\Stopwatch\Stopwatch;
use Symfony\Component\Stopwatch\StopwatchPeriod;

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

    public function test_task_must_succeed_and_take_over_5_seconds()
    {
        $message = new TaskMessage(
            TestDag::class,
            'task_1',
            \json_encode([
                'a' => 10,
                'b' => 20
            ])
        );

        $cb = function () use ($message) {


            $handler = $this->messageHandler;
            $handler($message);
        };

        $timeDelta = $this->timeMe('task_1', $cb);
        $this->assertGreaterThan(5000, $timeDelta);
        $this->assertEquals($message->getStatus(), TaskMessage::SUCCESS);
    }

    public function test_task_must_fail()
    {
        $message = new TaskMessage(
            TestDag::class,
            'task_2',
            \json_encode([])
        );
        $handler = $this->messageHandler;
        $handler($message);
        $this->assertEquals($message->getStatus(), TaskMessage::FAILED);
    }

    public function test_task_must_return_value()
    {
        $message = new TaskMessage(
            TestDag::class,
            'task_3',
            \json_encode([
                'a' => 10,
                'b' => 20
            ])
        );
        $handler = $this->messageHandler;
        $handler($message);
        $this->assertEquals($message->getStatus(), TaskMessage::SUCCESS);
    }

    /**
     * @param string $eventName
     * @param callable $cb
     * @return mixed
     */
    private function timeMe(string $eventName, callable $cb)
    {
        $stopwatch = new Stopwatch();
        // starts event named 'eventName'
        $event = $stopwatch->start($eventName);
        $cb();
        $event->stop();
        /**
         * @var StopwatchPeriod $period
         */
        foreach ($event->getPeriods() as $period) {
            return $period->getDuration();
        }
    }

}