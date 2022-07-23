<?php
/**
 * Created by PhpStorm.
 * User: chehimi
 * Date: 23/07/22
 * Time: 08:03 ص
 */

namespace Proxima\JobBundle\Tests\Registry;


use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Proxima\JobBundle\Registry\DagRegistry;

class DagRegistryIntegrationTest extends KernelTestCase
{
    public function testRegister()
    {
        self::bootKernel([
                'environment' => 'test',
                'debug'       => true,
            ]
        );
        $container = static::getContainer();
        /**
         * @var DagRegistry $dagRegistry
         */
        $dagRegistry = $container->get(DagRegistry::class);
        $dagRegistry->register();
        $this->assertInstanceOf(DagRegistry::class, $dagRegistry);

    }
}