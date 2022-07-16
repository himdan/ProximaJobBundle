<?php
/**
 * Created by PhpStorm.
 * User: chehimi
 * Date: 16/07/22
 * Time: 10:32 ص
 */

namespace Proxima\JobBundle\Registry;


interface DagRunInterface
{
    /**
     * @return callable[]
     */
    public function define(): array;
}