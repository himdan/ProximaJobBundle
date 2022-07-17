<?php
/**
 * Created by PhpStorm.
 * User: chehimi
 * Date: 16/07/22
 * Time: 07:22 م
 */

namespace Proxima\JobBundle;

use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\HttpKernel\Kernel as BaseKernel;

class Kernel extends BaseKernel
{
    use MicroKernelTrait;

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
       $loader->load(__DIR__.'/../config/services.yaml');
    }

}