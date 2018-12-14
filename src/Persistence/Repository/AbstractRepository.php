<?php

namespace App\Persistence\Repository;

use Doctrine\ORM\EntityManagerInterface;

abstract class AbstractRepository implements \App\Domain\Repository\AbstractRepositoryInterface
{
    /** @var EntityManagerInterface */
    protected $em;

    /**
     * AbstractRepositoryInterface constructor.
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function find($id)
    {
        return $this->em->getRepository(static::ENTITY)->find($id);
    }

    public function findAll()
    {
        return $this->em->getRepository(static::ENTITY)->findAll();
    }

    public function findBy(array $criteria, ?array $orderBy = null, $limit = null, $offset = null)
    {
        return $this->em->getRepository(static::ENTITY)->findBy($criteria, $orderBy, $limit, $offset);
    }

    public function findOneBy(array $criteria)
    {
        return $this->em->getRepository(static::ENTITY)->findOneBy($criteria);
    }

    public function persist($entity)
    {
        $this->em->persist($entity);
    }

    public function flush()
    {
        $this->em->flush();
    }
}