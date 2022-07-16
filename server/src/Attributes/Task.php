<?php
/**
 * Created by PhpStorm.
 * User: chehimi
 * Date: 16/07/22
 * Time: 08:54 ص
 */

namespace Proxima\JobBundle\Attributes;

use \Attribute;

#[Attribute(Attribute::TARGET_METHOD)]
class Task
{
    /**
     * @var ?string
     */
    public $name = "";

    /**
     * Task constructor.
     * @param string $name
     */
    public function __construct(string $name)
    {
        $this->name = $name;
    }


    public function __toString()
    {
        return sprintf("%s(name=%s)\n", self::class, $this->name);
    }

}