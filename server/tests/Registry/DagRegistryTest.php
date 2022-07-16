<?php
/**
 * Created by PhpStorm.
 * User: chehimi
 * Date: 16/07/22
 * Time: 03:19 م
 */

namespace Proxima\JobBundle\Tests\Registry;


use PHPUnit\Framework\TestCase;
use Proxima\JobBundle\Registry\DagConfigurator;
use Proxima\JobBundle\Registry\DagRegistry;

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

    public function testRegister()
    {
        $mock = $this->mockConfigurator();
        $dagRegistry = new DagRegistry($mock);
        $dagRegistry->register();
        $this->assertInstanceOf(DagRegistry::class, $dagRegistry);
    }
}