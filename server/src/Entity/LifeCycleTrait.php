<?php
/**
 * Created by PhpStorm.
 * User: chehimi
 * Date: 21/07/22
 * Time: 11:27 م
 */

namespace Proxima\JobBundle\Entity;

use Doctrine\ORM\Mapping as ORM;


trait LifeCycleTrait
{
    /**
     * @var ?int
     */
    #[ORM\Column(type:"integer", nullable: true, length: 2)]
    private $status;
    /**
     * @var \DateTimeInterface
     */
    #[ORM\Column(type:"datetime", nullable: true)]
    private $startAt;
    /**
     * @var  \DateTimeInterface
     */
    #[ORM\Column(type:"datetime", nullable: true)]
    private $endAt;

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status): void
    {
        $this->status = $status;
    }

    /**
     * @return \DateTimeInterface
     */
    public function getStartAt(): \DateTimeInterface
    {
        return $this->startAt;
    }

    /**
     * @param \DateTimeInterface $startAt
     */
    public function setStartAt(\DateTimeInterface $startAt): void
    {
        $this->startAt = $startAt;
    }

    /**
     * @return \DateTimeInterface
     */
    public function getEndAt(): \DateTimeInterface
    {
        return $this->endAt;
    }

    /**
     * @param \DateTimeInterface $endAt
     */
    public function setEndAt(\DateTimeInterface $endAt): void
    {
        $this->endAt = $endAt;
    }




}