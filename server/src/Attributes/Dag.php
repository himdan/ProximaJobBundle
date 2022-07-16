<?php
/**
 * Created by PhpStorm.
 * User: chehimi
 * Date: 16/07/22
 * Time: 08:52 ص
 */

namespace Proxima\JobBundle\Attributes;

/**
 * Class Dag
 * @package Proxima\JobBundle\Annotation
 */
#[Attribute(Attribute::TARGET_CLASS)]
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
}