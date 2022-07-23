<?php
/**
 * Created by PhpStorm.
 * User: chehimi
 * Date: 23/07/22
 * Time: 11:11 ص
 */

namespace Proxima\JobBundle\EntityManager;


interface RunTimeEntityManagerInterface
{
    public function hasStashedEntity(string $metaClassName): bool;

    public function getStashedEntity(string $metaClassName): array;

    public function persistAndStash(object &$object): void;

    public function flushAndPurge(): void ;
}