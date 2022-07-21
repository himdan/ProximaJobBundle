<?php
/**
 * Created by PhpStorm.
 * User: chehimi
 * Date: 21/07/22
 * Time: 11:27 م
 */

namespace Proxima\JobBundle\Entity;


trait LifeCycleTrait
{
    /**
     * @var ?int
     */
    private $status;
    /**
     * @var \DateTimeInterface
     */
    private $startAt;
    /**
     * @var  \DateTimeInterface
     */
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