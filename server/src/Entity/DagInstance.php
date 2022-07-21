<?php
/**
 * Created by PhpStorm.
 * User: chehimi
 * Date: 21/07/22
 * Time: 11:21 م
 */

namespace Proxima\JobBundle\Entity;

class DagInstance
{
    use PersistentTrait;
    use LifeCycleTrait;
    /**
     * @var string $class
     */
    private $class;



}