<?php
/**
 * Created by PhpStorm.
 * User: chehimi
 * Date: 21/07/22
 * Time: 11:19 م
 */

namespace Proxima\JobBundle\Entity;


class TaskInstance
{
    use PersistentTrait;
    use LifeCycleTrait;
    /**
     * @var ?DagInstance $dagInstance
     */
    private $dagInstance;

    /**
     * TaskInstance constructor.
     * @param $dagInstance
     */
    public function __construct($dagInstance)
    {
        $this->dagInstance = $dagInstance;
    }

    /**
     * @return mixed
     */
    public function getDagInstance()
    {
        return $this->dagInstance;
    }




}