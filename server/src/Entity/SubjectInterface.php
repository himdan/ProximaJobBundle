<?php
/**
 * Created by PhpStorm.
 * User: chehimi
 * Date: 23/07/22
 * Time: 06:11 م
 */

namespace Proxima\JobBundle\Entity;


interface SubjectInterface
{
    /**
     * @return mixed
     */
    public function getSubjectId();
    public function getSubjectClass(): ?string;
    public function getConnection(): ?string;
}