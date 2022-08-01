<?php
/**
 * Created by PhpStorm.
 * User: chehimi
 * Date: 21/07/22
 * Time: 11:21 م
 */

namespace Proxima\JobBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

#[ORM\Entity]
class DagInstance implements SubjectInterface
{
    use PersistentTrait;

    use CurrentPlaceTrait;
    use LifeCycleTrait;
    use SubjectTrait;

    /**
     * @var ?Dag $dag
     */
    #[ORM\ManyToOne(targetEntity:Dag::class, inversedBy:'instances')]
    private $dag;
    /**
     * @var ArrayCollection|TaskInstance[]
     */
    #[ORM\OneToMany(targetEntity:TaskInstance::class, mappedBy:'dagInstance')]
    private $tasksInstances;

    /**
     * DagInstance constructor.
     */
    public function __construct()
    {
        $this->tasksInstances = new ArrayCollection([]);
    }

    /**
     * @return mixed
     */
    public function getDag()
    {
        return $this->dag;
    }

    /**
     * @param mixed $dag
     */
    public function setDag($dag): void
    {
        $this->dag = $dag;
    }

    /**
     * @return ArrayCollection|TaskInstance[]
     */
    public function getTasksInstances()
    {
        return $this->tasksInstances;
    }

    /**
     * @param ArrayCollection|TaskInstance[] $tasksInstances
     */
    public function setTasksInstances($tasksInstances): void
    {
        $this->tasksInstances = $tasksInstances;
    }




}