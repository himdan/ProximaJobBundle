<?php
/**
 * Created by PhpStorm.
 * User: chehimi
 * Date: 21/07/22
 * Time: 11:33 م
 */

namespace Proxima\JobBundle\Entity;


trait PersistentTrait
{
    private $id;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }


}