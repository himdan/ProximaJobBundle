<?php
/**
 * Created by PhpStorm.
 * User: chehimi
 * Date: 23/07/22
 * Time: 10:59 ص
 */

namespace Proxima\JobBundle\EntityManager;


use Proxima\JobBundle\Entity\Dag;
use Proxima\JobBundle\Entity\Task;

class RunTimeRegistry extends AbstractRunTimeRegistry
{
    public static function getRegisteredEquityCallable()
    {
        $rEC = [];
        $rEC[Dag::class] = function (Dag $a, Dag $b) {
            return $a->getClassName() == $b->getClassName();
        };
        $rEC[Task::class] = function (Task $a, Task $b) use ($rEC) {
            return $a->getName() == $b->getName() && $rEC[Dag::class]($a->getDag(), $b->getDag());
        };
        return $rEC;
    }

}