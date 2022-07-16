<?php
/**
 * Created by PhpStorm.
 * User: chehimi
 * Date: 16/07/22
 * Time: 01:29 م
 */

namespace Proxima\JobBundle\Registry;


class DagConfigurator implements DagKernelInterface
{
    /**
     * @var string
     */
    private $namespace;
    /**
     * @var string
     */
    private $rootPath;

    public function __construct(string $namespace, string $rootPath)
    {
        $this->namespace = $namespace;
        $this->rootPath = $rootPath;
    }

    public function getDagProjectDirectory(): string
    {
        return $this->rootPath;
    }

    public function getDagNamespace(): string
    {
        return $this->namespace;
    }

}