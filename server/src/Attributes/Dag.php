<?php
/**
 * Created by PhpStorm.
 * User: chehimi
 * Date: 16/07/22
 * Time: 08:52 ص
 */

namespace Proxima\JobBundle\Attributes;

use \Attribute;

/**
 * Class Dag
 * @package Proxima\JobBundle\Annotation
 */
#[Attribute]
class Dag
{
    /**
     * @var string $name
     */
    public $name;
    /**
     * @var ?string
     */
    public $tag;

    /**
     * Dag constructor.
     * @param string $name
     * @param $tag
     */
    public function __construct(string $name = "", $tag = "")
    {
        $this->name = $name;
        $this->tag = $tag;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return sprintf("%s(name=%s, tag=%s) \n", self::class, $this->name, $this->tag);
    }


}