<?php
/**
 * Created by PhpStorm.
 * User: chehimi
 * Date: 23/07/22
 * Time: 09:46 ص
 */

namespace Proxima\JobBundle\EntityManager;


use BadMethodCallException;
use DateTimeInterface;
use Doctrine\Common\EventManager;
use Doctrine\DBAL\Connection;
use Doctrine\ORM\Cache;
use Doctrine\ORM\Configuration;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Exception\ORMException;
use Doctrine\ORM\Internal\Hydration\AbstractHydrator;
use Doctrine\ORM\Mapping;
use Doctrine\ORM\NativeQuery;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\PessimisticLockException;
use Doctrine\ORM\Proxy\ProxyFactory;
use Doctrine\ORM\Query;
use Doctrine\ORM\Query\Expr;
use Doctrine\ORM\Query\FilterCollection;
use Doctrine\ORM\Query\ResultSetMapping;
use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\UnitOfWork;

/**
 * Class RunTimeEntityManager
 * @package Proxima\JobBundle\EntityManager
 *
 */
class RunTimeEntityManager implements EntityManagerInterface, RunTimeEntityManagerInterface

{

    /**
     * @var EntityManagerInterface $entityManager
     */
    private $entityManager;
    /**
     * @var AbstractRunTimeRegistry $runTimeRegistry
     */
    private $runTimeRegistry;

    private $stashedRegistry = [];

    /**
     * RunTimeEntityManager constructor.
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param AbstractRunTimeRegistry $runTimeRegistry
     */
    public function setRunTimeRegistry(AbstractRunTimeRegistry $runTimeRegistry): void
    {
        $this->runTimeRegistry = $runTimeRegistry;
    }

    /**
     * @param $className
     * @return mixed
     */
    public function getRepository($className)
    {
        return $this->entityManager->getRepository($className);
    }

    /**
     * @return Cache|null
     */
    public function getCache()
    {
        return $this->entityManager->getCache();
    }

    /**
     * @return Connection
     */
    public function getConnection()
    {
        return $this->entityManager->getConnection();
    }

    /**
     * @return Expr
     */
    public function getExpressionBuilder()
    {
        return $this->entityManager->getExpressionBuilder();
    }

    public function beginTransaction(): void
    {
        $this->entityManager->beginTransaction();
    }

    /**
     * @param callable $func
     * @return mixed
     */
    public function transactional($func)
    {
        return $this->entityManager->transactional($func);
    }

    public function commit(): void
    {
        $this->entityManager->commit();
    }

    public function rollback(): void
    {
        $this->entityManager->rollback();
    }

    /**
     * @param string $dql
     * @return Query
     */
    public function createQuery($dql = '')
    {
        return $this->entityManager->createQuery($dql);
    }

    /**
     * @param string $name
     * @return Query
     */
    public function createNamedQuery($name)
    {
        return $this->entityManager->createNamedQuery($name);
    }

    /**
     * @param string $sql
     * @param ResultSetMapping $rsm
     * @return NativeQuery
     */
    public function createNativeQuery($sql, ResultSetMapping $rsm)
    {
        return $this->entityManager->createNativeQuery($sql, $rsm);
    }

    /**
     * @param string $name
     * @return NativeQuery
     */
    public function createNamedNativeQuery($name)
    {
        return $this->entityManager->createNamedNativeQuery($name);
    }

    /**
     * @return QueryBuilder
     */
    public function createQueryBuilder()
    {
        return $this->entityManager->createQueryBuilder();
    }

    /**
     * @param string $entityName
     * @param mixed $id
     * @return object|null
     * @throws ORMException
     */
    public function getReference($entityName, $id)
    {
        return $this->entityManager->getReference($entityName, $id);
    }

    /**
     * @param string $entityName
     * @param mixed $identifier
     * @return object|null
     */
    public function getPartialReference($entityName, $identifier)
    {
        return $this->entityManager->getPartialReference($entityName, $identifier);
    }

    public function close(): void
    {
        $this->entityManager->close();
    }

    /**
     * @param object $entity
     * @param bool $deep
     * @return object
     */
    public function copy($entity, $deep = false)
    {
        return $this->entityManager->copy($entity, $deep);
    }

    /**
     * @param object $entity
     * @param int $lockMode
     * @param null $lockVersion
     * @throws OptimisticLockException
     * @throws PessimisticLockException
     */
    public function lock($entity, $lockMode, $lockVersion = null): void
    {
        $this->entityManager->lock($entity, $lockMode, $lockVersion);
    }

    /**
     * @return EventManager
     */
    public function getEventManager()
    {
        return $this->entityManager->getEventManager();
    }

    /**
     * @return Configuration
     */
    public function getConfiguration()
    {
        return $this->entityManager->getConfiguration();
    }

    /**
     * @return bool
     */
    public function isOpen()
    {
        return $this->entityManager->isOpen();
    }

    /**
     * @return UnitOfWork
     */
    public function getUnitOfWork()
    {
        return $this->entityManager->getUnitOfWork();
    }

    /**
     * @param int|string $hydrationMode
     * @return AbstractHydrator
     */
    public function getHydrator($hydrationMode)
    {
        return $this->entityManager->getHydrator($hydrationMode);
    }

    /**
     * @param int|string $hydrationMode
     * @return AbstractHydrator
     * @throws ORMException
     */
    public function newHydrator($hydrationMode)
    {
        return $this->entityManager->newHydrator($hydrationMode);
    }

    /**
     * @return ProxyFactory
     */
    public function getProxyFactory()
    {
        return $this->entityManager->getProxyFactory();
    }

    /**
     * @return FilterCollection
     */
    public function getFilters()
    {
        return $this->entityManager->getFilters();
    }

    /**
     * @return bool
     */
    public function isFiltersStateClean()
    {
        return $this->entityManager->isFiltersStateClean();
    }

    /**
     * @return bool
     */
    public function hasFilters()
    {
        return $this->entityManager->hasFilters();
    }

    /**
     * @param $className
     * @return Mapping\ClassMetadata
     */
    public function getClassMetadata($className)
    {
        return $this->entityManager->getClassMetadata($className);
    }

    /**
     * @param string $className
     * @param mixed $id
     * @return object|null
     */
    public function find(string $className, $id)
    {
        return $this->entityManager->find($className, $id);
    }

    public function persist(object $object): void
    {
        $this->entityManager->persist($object);
    }


    /**
     * @param object $object
     */
    public function remove(object $object): void
    {
        $this->entityManager->remove($object);
    }


    public function clear(): void
    {
        $this->entityManager->clear();
    }

    public function detach(object $object): void
    {
        $this->entityManager->detach($object);
    }

    public function refresh(object $object): void
    {
        $this->entityManager->refresh($object);
    }

    public function flush(): void
    {
        $this->entityManager->flush();
    }


    public function flushAndPurge(): void
    {
        $this->flush();
        $this->stashedRegistry = [];
    }

    /**
     * @return Mapping\ClassMetadataFactory
     */
    public function getMetadataFactory(): Mapping\ClassMetadataFactory
    {
        return $this->entityManager->getMetadataFactory();
    }

    public function initializeObject(object $obj): void
    {
        $this->entityManager->initializeObject($obj);
    }

    /**
     * @param object $object
     * @return bool
     */
    public function contains(object $object)
    {
        return $this->entityManager->contains($object);
    }

    /**
     * @param callable $func
     * @return mixed
     */
    public function wrapInTransaction(callable $func)
    {
        return $this->transactional($func);
    }

    /**
     * @param Object $object
     * @return bool
     */
    private function containsSameObject(Object &$object)
    {
        return $this->runTimeRegistry->register($this, $object);
    }

    private function stash(object $object)
    {
        $className = get_class($object);
        $this->stashedRegistry[$className] = isset($this->stashedRegistry[$className]) ? $this->stashedRegistry[$className] : [];
        $this->stashedRegistry[$className] = is_array($this->stashedRegistry[$className]) ? $this->stashedRegistry[$className] : [];
        array_push($this->stashedRegistry[$className], $object);
    }

    public function getStashedEntity(string $metaClassName): array
    {
        return isset($this->stashedRegistry[$metaClassName]) ? $this->stashedRegistry[$metaClassName] : [];
    }

    public function hasStashedEntity(string $metaClassName): bool
    {
        return array_key_exists($metaClassName, $this->stashedRegistry);
    }


    public function persistAndStash(object &$object): void
    {
        if (!$this->containsSameObject($object)) {
            $this->stash($object);
            $this->persist($object);
        }
    }


}