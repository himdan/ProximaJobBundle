<?php
/**
 * Created by PhpStorm.
 * User: chehimi
 * Date: 16/07/22
 * Time: 10:30 ص
 */

namespace Proxima\JobBundle\Registry;


interface TaskRunInterface
{
    public function __invoke();
}