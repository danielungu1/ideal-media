<?php declare(strict_types=1);

namespace App\Facade;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectRepository;

abstract class BaseFacade
{

    protected ObjectRepository $repository;

    public function __construct(protected EntityManagerInterface $em, string $entityClassName)
    {
        $this->repository = $this->em->getRepository($entityClassName);
    }

    //////////////////////////////////////////////////////// Public

    public function find(string $id = null): ?object
    {
        return $id ? $this->repository->find($id) : null;
    }

    public function findOneBy(array $criteria): ?object
    {
        return $this->repository->findOneBy($criteria);
    }

}
