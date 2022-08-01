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
     * @var ?string
     */
    public $workflow = null;

    /**
     * Task constructor.
     * @param string $name
     */
    public function __construct(string $name, ?string $workflow=null)
    {
        $this->name = $name;
        $this->workflow = $workflow;
    }


    public function __toString()
    {
        return sprintf("%s(name=%s)\n", self::class, $this->name);
    }

}