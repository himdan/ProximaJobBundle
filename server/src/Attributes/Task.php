<?php
/**
 * Created by PhpStorm.
 * User: chehimi
 * Date: 16/07/22
 * Time: 08:54 ص
 */

namespace Proxima\JobBundle\Attributes;

#[Attribute(Attribute::TARGET_METHOD)]
abstract class Task
{
    /**
     * @var ?string
     */
    public $name = "";
}