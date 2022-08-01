<?php
/**
 * Created by PhpStorm.
 * User: chehimi
 * Date: 22/07/22
 * Time: 09:50 م
 */

namespace Proxima\JobBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Proxima\JobBundle\Repository\TaskRepository;


/**
 * Class Task
 * @package Proxima\JobBundle\Entity
 */
#[ORM\Entity(repositoryClass:TaskRepository::class)]
class Task
{
    use PersistentTrait;

    /**
     * @var string $name
     */
    #[ORM\Column(type:'string', nullable: true)]
    private $name;

    #[ORM\Column(type:'string', nullable: true)]
    private $workflow;
    /**
     * @var ?Dag $dag
     */
    #[ORM\ManyToOne(targetEntity:Dag::class, inversedBy:'tasks')]
    private $dag;


    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
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
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getWorkflow()
    {
        return $this->workflow;
    }

    /**
     * @param mixed $workflow
     */
    public function setWorkflow($workflow): void
    {
        $this->workflow = $workflow;
    }


}