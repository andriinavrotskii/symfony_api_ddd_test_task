<?php

namespace App\Persistence\Repository;

use Doctrine\ORM\EntityManagerInterface;

abstract class BaseRepository
{
    /** @var \Doctrine\Common\Persistence\ObjectRepository */
    private $repository;

    /**
     * ProductRepository constructor.
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->repository = $entityManager->getRepository(static::ENTITY);
    }

    public function find($id)
    {
        return $this->repository->find($id);
    }

    public function findAll()
    {
        return $this->repository->findAll();
    }

    public function findBy(array $criteria, ?array $orderBy = null, $limit = null, $offset = null)
    {
        return $this->repository->findBy($criteria, $orderBy, $limit, $offset);
    }

    public function findOneBy(array $criteria)
    {
        return $this->repository->findOneBy($criteria);
    }
}