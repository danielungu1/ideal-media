<?php declare(strict_types=1);

namespace App\Model\Facade;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ObjectRepository;

abstract class BaseFacade
{

    protected ObjectRepository $repository;

    public function __construct(protected EntityManagerInterface $em, string $entityClassName)
    {
        $this->repository = $this->em->getRepository($entityClassName);
    }

    //////////////////////////////////////////////////////// Public

    public function findAll(): array
    {
        return $this->repository->findAll();
    }

    public function find(string $id = null): ?object
    {
        return $id ? $this->repository->find($id) : null;
    }

    public function findOneBy(array $criteria): ?object
    {
        return $this->repository->findOneBy($criteria);
    }

    public function findBy(array $criteria, array $order = null, int $limit = null, int $offset = null): array
    {
        return $this->repository->findBy($criteria, $order, $limit, $offset);
    }

    public function createQueryBuilder(): QueryBuilder
    {
        return $this->em->createQueryBuilder();
    }

    public function getQueryBuilder(string $alias = 'e'): QueryBuilder
    {
        $qb = $this->createQueryBuilder();
        $qb->select($alias);
        $qb->from($this->repository->getClassName(), $alias);

        return $qb;
    }

}
