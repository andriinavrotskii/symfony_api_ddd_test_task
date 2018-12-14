<?php
namespace App\Domain\Repository;

interface AbstractRepositoryInterface
{
    public function find($id);

    public function findAll();

    public function findBy(array $criteria, ?array $orderBy = null, $limit = null, $offset = null);

    public function findOneBy(array $criteria);

    public function persist($entity);

    public function flush();
}