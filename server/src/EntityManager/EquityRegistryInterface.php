<?php
/**
 * Created by PhpStorm.
 * User: chehimi
 * Date: 23/07/22
 * Time: 10:25 ص
 */

namespace Proxima\JobBundle\EntityManager;


interface EquityRegistryInterface
{
    public static function getRegisteredEquityCallable();
}