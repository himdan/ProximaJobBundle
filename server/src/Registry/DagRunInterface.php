<?php
/**
 * Created by PhpStorm.
 * User: chehimi
 * Date: 16/07/22
 * Time: 10:32 ص
 */

namespace Proxima\JobBundle\Registry;

use Symfony\Component\Workflow\WorkflowInterface;

interface DagRunInterface
{
    /**
     * @return callable[]| WorkflowInterface
     */
    public function define();
}