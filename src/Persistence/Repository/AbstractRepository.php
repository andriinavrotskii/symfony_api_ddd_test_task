<?php

namespace App\Persistence\Repository;

use Doctrine\ORM\EntityManagerInterface;

abstract class AbstractRepository
{
    /** @var EntityManagerInterface */
    protected $em;

    /**
     * AbstractRepository constructor.
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

    public function save( $product)
    {
        $this->em->persist($product);
        $this->em->flush();
        return $product;
    }
}