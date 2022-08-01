<?php
/**
 * Created by PhpStorm.
 * User: chehimi
 * Date: 21/07/22
 * Time: 11:19 م
 */

namespace Proxima\JobBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class TaskInstance
 * @package Proxima\JobBundle\Entity
 */
#[ORM\Entity]
class TaskInstance
{
    use PersistentTrait;
    use LifeCycleTrait;
    /**
     * @var ?DagInstance $dagInstance
     */
    #[ORM\ManyToOne(targetEntity:DagInstance::class, inversedBy:'tasksInstances')]
    private $dagInstance;
    /**
     * @var Task $task
     */
    #[ORM\ManyToOne(targetEntity:Task::class)]
    private $task;

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

    /**
     * @param Task $task
     */
    public function setTask(Task $task): void
    {
        $this->task = $task;
    }

    /**
     * @return Task
     */
    public function getTask(): Task
    {
        return $this->task;
    }








}