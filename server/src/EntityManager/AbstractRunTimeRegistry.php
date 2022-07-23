<?php
/**
 * Created by PhpStorm.
 * User: chehimi
 * Date: 23/07/22
 * Time: 10:22 ص
 */

namespace Proxima\JobBundle\EntityManager;

abstract class AbstractRunTimeRegistry implements EquityRegistryInterface
{


    public function register(RunTimeEntityManager $rem, object &$object): bool
    {
        $metaClass = get_class($object);
        if (!self::hasEquityCallback($metaClass) || !$rem->hasStashedEntity($metaClass)) {
            return false;
        }
        $registry = static::getRegisteredEquityCallable();
        $cb = $registry[$metaClass];
        foreach ($rem->getStashedEntity($metaClass) as $matchCandidate) {
            if ($cb($object, $matchCandidate)) {
                $object = $matchCandidate;
                return true;
            }
        }

        return false;

    }

    private static function hasEquityCallback(string $targetMetaClass): bool
    {
        return array_key_exists($targetMetaClass, static::getRegisteredEquityCallable());
    }
}