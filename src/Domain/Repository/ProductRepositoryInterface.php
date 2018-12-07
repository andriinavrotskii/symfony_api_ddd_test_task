<?php

namespace App\Domain\Repository;

use App\Domain\Model\Product;

interface ProductRepositoryInterface
{
    /**
     * @param $id
     * @return Product
     */
    public function find($id);

    /**
     * @return Product[]
     */
    public function findAll();

    /**
     * @param mixed[]       $criteria
     * @param string[]|null $orderBy
     * @param int|null      $limit
     * @param int|null      $offset
     *
     * @return Product[]
     */
    public function findBy(array $criteria, ?array $orderBy = null, $limit = null, $offset = null);

    /**
     * @param mixed[] $criteria The criteria.
     *
     * @return Product|null
     */
    public function findOneBy(array $criteria);
}
