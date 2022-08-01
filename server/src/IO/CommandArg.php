<?php
/**
 * Created by PhpStorm.
 * User: chehimi
 * Date: 23/07/22
 * Time: 06:51 م
 */

namespace Proxima\JobBundle\IO;


use Proxima\JobBundle\Entity\SubjectInterface;

class CommandArg implements SubjectInterface
{

    private $subjectId;
    private $subjectClass;
    private $connection;

    /**
     * @param mixed $subjectId
     */
    public function setSubjectId($subjectId): void
    {
        $this->subjectId = $subjectId;
    }

    /**
     * @param mixed $subjectClass
     */
    public function setSubjectClass($subjectClass): void
    {
        $this->subjectClass = $subjectClass;
    }

    /**
     * @param mixed $connection
     */
    public function setConnection($connection): void
    {
        $this->connection = $connection;
    }



    public function getSubjectId()
    {
        return $this->subjectId;
    }

    public function getSubjectClass(): ?string
    {
        return $this->subjectClass;
    }

    public function getConnection(): ?string
    {
        return $this->connection;
    }

}