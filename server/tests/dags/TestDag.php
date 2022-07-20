<?php
/**
 * Created by PhpStorm.
 * User: chehimi
 * Date: 16/07/22
 * Time: 03:40 م
 */

namespace Proxima\JobBundle\Tests\Dags;


use Proxima\JobBundle\Registry\DagDefinitionInterface;
use Proxima\JobBundle\Registry\DagRunInterface;
use Proxima\JobBundle\Attributes\Dag;
use Proxima\JobBundle\Attributes\Task;
use Proxima\JobBundle\Registry\TaskRunInterface;

#[DAG("test_dag", "test")]
class TestDag implements DagRunInterface
{
    /**
     * @return callable[]
     */
    public function define(): array
    {
        return [
            [$this, 'task_1'],
            [$this, 'task_2'],
            [$this, 'task_3'],
        ];
    }
    /**
     * @return TaskRunInterface|void
     */
    #[Task("task_1")]
    public function task_1()
    {
        sleep(10);
    }
    /**
     * @return TaskRunInterface|void
     */
    #[Task("task_2")]
    public function task_2()
    {

    }

    /**
     * @return TaskRunInterface|void
     */
    #[Task("task_2")]
    public function task_3()
    {

    }

}