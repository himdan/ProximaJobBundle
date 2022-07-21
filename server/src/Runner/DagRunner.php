<?php
/**
 * Created by PhpStorm.
 * User: chehimi
 * Date: 18/07/22
 * Time: 11:08 م
 */

namespace Proxima\JobBundle\Runner;


use Proxima\JobBundle\Registry\DagRunInterface;

class DagRunner
{
    private  function extractWorkflow(DagRunInterface $dagRun)
    {

        foreach ($dagRun->define() as $task) {
            if(!is_array($task)){
                continue;
            }
            $dagClass = get_class($task[0]);
            $task = $task[1];
        }

    }

    public function run()
    {

    }
}