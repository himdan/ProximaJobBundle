<?php
/**
 * Created by PhpStorm.
 * User: chehimi
 * Date: 16/07/22
 * Time: 04:37 م
 */

namespace Proxima\JobBundle\Tests\Dags;

use Proxima\JobBundle\Registry\DagRunInterface;
use Proxima\JobBundle\Attributes\Dag;
use Proxima\JobBundle\Attributes\Task;
use Proxima\JobBundle\Registry\TaskRunInterface;
use Symfony\Component\Workflow\Workflow;

#[DAG("etl_dag", "test")]
class EtlDag implements DagRunInterface
{
    /**
     * @return callable[]|Workflow
     */
    public function define()
    {
        return [
            [$this, 'extract'],
            [$this, 'transform'],
            [$this, 'load'],
        ];
    }

    #[Task("extract")]
    public function extract(): TaskRunInterface
    {

    }

    #[Task("transform")]
    public function transform(): TaskRunInterface
    {

    }


    #[Task("load")]
    public function load(): TaskRunInterface
    {

    }
}