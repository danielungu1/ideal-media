<?php declare(strict_types=1);

namespace App\Model\Service;

use Doctrine\ORM\EntityManagerInterface;

abstract class BaseService
{

    public function __construct(protected EntityManagerInterface $em)
    {
    }

    public function save($entity)
    {
        $this->em->persist($entity);
        $this->em->flush();

        return $entity;
    }

    public function delete($entity)
    {
        $this->em->remove($entity);
        $this->em->flush();

        return $entity;
    }

}
