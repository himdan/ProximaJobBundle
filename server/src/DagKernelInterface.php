<?php
/**
 * Created by PhpStorm.
 * User: chehimi
 * Date: 16/07/22
 * Time: 11:30 ص
 */

namespace Proxima\JobBundle;


use Symfony\Component\HttpKernel\KernelInterface;

interface DagKernelInterface extends KernelInterface
{
    public function getDagProjectDirectory():string;
}