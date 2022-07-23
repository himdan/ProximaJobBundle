<?php
/**
 * Created by PhpStorm.
 * User: chehimi
 * Date: 22/07/22
 * Time: 09:49 م
 */

namespace Proxima\JobBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Class Dag
 * @package Proxima\JobBundle\Entity
 */
#[ORM\Entity()]
class Dag
{
    use PersistentTrait;
    /**
     * @var ?string $className
     */
    #[ORM\Column(type:"string", nullable:true)]
    private ?string $className;
    /**
     * @var Task[]|ArrayCollection
     */
    #[ORM\OneToMany(targetEntity:Task::class, mappedBy: 'dag')]
    private $tasks;

    /**
     * Dag constructor.
     */
    public function __construct()
    {
        $this->tasks = new ArrayCollection([]);
    }


    /**
     * @return mixed
     */
    public function getClassName()
    {
        return $this->className;
    }

    /**
     * @param mixed $className
     */
    public function setClassName($className): void
    {
        $this->className = $className;
    }

    /**
     * @return Task[]
     */
    public function getTasks(): array
    {
        return $this->tasks;
    }

    /**
     * @param Task[] $tasks
     */
    public function setTasks(array $tasks): void
    {
        $this->tasks = $tasks;
    }


    public function addTask(Task $task){

    }

    public function removeTask(Task $task)
    {

    }

    public function __toString()
    {
        return sprintf('%s', $this->getClassName());
    }


}