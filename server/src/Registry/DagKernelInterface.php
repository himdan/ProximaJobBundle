<?php
/**
 * Created by PhpStorm.
 * User: chehimi
 * Date: 16/07/22
 * Time: 11:30 ص
 */

namespace Proxima\JobBundle\Registry;

interface DagKernelInterface
{
    public function getDagProjectDirectory(): string;

    public function getDagNamespace(): string;
}