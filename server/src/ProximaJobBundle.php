<?php
/**
 * Created by PhpStorm.
 * User: chehimi
 * Date: 16/07/22
 * Time: 11:46 ص
 */

namespace Proxima\JobBundle;


use Symfony\Component\HttpKernel\Bundle\AbstractBundle;

class ProximaJobBundle extends AbstractBundle
{
    public function getPath(): string
    {
        return __DIR__;
    }
}