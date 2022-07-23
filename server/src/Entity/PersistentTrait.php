<?php
/**
 * Created by PhpStorm.
 * User: chehimi
 * Date: 21/07/22
 * Time: 11:33 م
 */

namespace Proxima\JobBundle\Entity;

use Doctrine\ORM\Mapping as ORM;


trait PersistentTrait
{

    #[ORM\Id]
    #[ORM\GeneratedValue(strategy:'AUTO')]
    #[ORM\Column]
    private ?int $id;

    /**
     * @return int?
     */
    public function getId(): int
    {
        return $this->id;
    }


}