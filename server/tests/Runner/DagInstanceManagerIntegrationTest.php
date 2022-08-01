<?php
/**
 * Created by PhpStorm.
 * User: chehimi
 * Date: 23/07/22
 * Time: 05:06 م
 */

namespace Proxima\JobBundle\Tests\Runner;


use Doctrine\ORM\EntityManagerInterface;
use Proxima\JobBundle\Entity\Dag;
use Proxima\JobBundle\Entity\DagInstance;
use Proxima\JobBundle\Runner\DagInstanceManager;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class DagInstanceManagerIntegrationTest extends KernelTestCase
{


    public function testMakeDagInstance()
    {
        self::bootKernel([
                'environment' => 'test',
                'debug' => false,
            ]
        );
        $container = static::getContainer();
        /**
         * @var DagInstanceManager $dagInstanceManager
         */
        $dagInstanceManager = $container->get(DagInstanceManager::class);
        $em = $container->get(EntityManagerInterface::class);
        $dag = $em->find(Dag::class, 6);
        $dagInstance = $dagInstanceManager->makeDagInstance($dag);
        $this->assertNotNull($dagInstance->getId());

    }
}