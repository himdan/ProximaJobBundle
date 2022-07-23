<?php
/**
 * Created by PhpStorm.
 * User: chehimi
 * Date: 22/07/22
 * Time: 10:18 م
 */

namespace Proxima\JobBundle\Repository;


use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Proxima\JobBundle\Entity\Task;

class TaskRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Task::class);
    }

    /**
     * @param string $className
     * @param string $taskName
     * @return Task|null
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function findOneByDagClassNameAndTaskName(
        string $className,
        string $taskName
    ): ?Task
    {
        $qb = $this->_em->createQueryBuilder();
        $qb
            ->select('task')
            ->from(Task::class, 'task')
            ->innerJoin('task.dag', 'dag');
        $qb
            ->where('dag.className=:className')
            ->andWhere('task.name=:taskName')
            ->setParameter('className', $className)
            ->setParameter('taskName', $taskName);

        $qb->setMaxResults(1);

        return $qb->getQuery()->getOneOrNullResult();
    }

}