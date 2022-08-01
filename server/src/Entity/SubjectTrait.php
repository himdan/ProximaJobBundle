<?php
/**
 * Created by PhpStorm.
 * User: chehimi
 * Date: 23/07/22
 * Time: 06:03 م
 */

namespace Proxima\JobBundle\Entity;

use Doctrine\ORM\Mapping as ORM;


trait SubjectTrait
{
    /**
     * @var string|int $subjectId
     */
    #[ORM\Column(type:"string", nullable: true)]
    private $subjectId;
    /**
     * @var ?string $subjectClass
     */
    #[ORM\Column(type:"string", nullable: true)]
    private $subjectClass;
    /**
     * @var ?string
     */
    #[ORM\Column(type:"string", nullable: true)]
    private $connection = 'default';

    /**
     * @return int|string|null
     */
    public function getSubjectId()
    {
        return $this->subjectId;
    }

    /**
     * @return string
     */
    public function getSubjectClass(): ?string
    {
        return $this->subjectClass;
    }

    /**
     * @return string
     */
    public function getConnection(): ?string
    {
        return $this->connection;
    }


}