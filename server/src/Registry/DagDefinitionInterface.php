<?php
/**
 * Created by PhpStorm.
 * User: chehimi
 * Date: 16/07/22
 * Time: 10:33 ص
 */

namespace Proxima\JobBundle\Registry;


interface DagDefinitionInterface
{
    public function next();
}