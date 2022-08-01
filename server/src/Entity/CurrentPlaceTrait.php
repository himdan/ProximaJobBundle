<?php
/**
 * Created by PhpStorm.
 * User: chehimi
 * Date: 23/07/22
 * Time: 03:54 م
 */

namespace Proxima\JobBundle\Entity;

use Doctrine\ORM\Mapping as ORM;


trait CurrentPlaceTrait
{

    /**
     * @var string|null $currentPlace
     */
    #[ORM\Column(type:"string", nullable: true)]
    private $currentPlace;

    // getter/setter methods must exist for property access by the marking store
    public function getCurrentPlace()
    {
        return $this->currentPlace;
    }

    public function setCurrentPlace($currentPlace, $context = [])
    {
        $this->currentPlace = $currentPlace;
    }
}