<?php
/**
 * Created by PhpStorm.
 * User: chehimi
 * Date: 23/07/22
 * Time: 03:35 م
 */

namespace Proxima\JobBundle\Tests\Dags;

use Proxima\JobBundle\Entity\SubjectInterface;
use Proxima\JobBundle\Registry\DagRunInterface;
use Proxima\JobBundle\Attributes\Dag;
use Proxima\JobBundle\Attributes\Task;
use Proxima\JobBundle\Registry\TaskRunInterface;
use Symfony\Component\Workflow\Workflow;
use Symfony\Component\Workflow\WorkflowInterface;

#[DAG("pull_request_dag", "test")]
class PullRequestDag implements DagRunInterface
{

    public function define(): array
    {
        return [
            [$this, 'toReview'],
            [$this, 'publish'],
            [$this, 'load'],
        ];
    }

    #[Task(name:"to_review", workflow:"workflow.blog_publishing")]
    public function toReview()
    {
        sleep(5);
    }
    /**
     * @throws \Exception
     */
    #[Task(name:"publish", workflow:"workflow.blog_publishing")]
    public function publish()
    {
        throw new \Exception('I Failed');
    }

    /**
     * @return TaskRunInterface|void
     */
    #[Task(name:"reject", workflow:"workflow.blog_publishing")]
    public function reject()
    {

    }


}