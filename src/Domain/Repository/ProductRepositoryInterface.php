<?php

namespace App\Domain\Repository;

use App\Domain\Model\Product;
use App\Domain\Model\ProductInterface;

interface ProductRepositoryInterface
{
    const ENTITY = Product::class;

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

    /**
     * @param ProductInterface $product
     * @return mixed
     */
    public function save(ProductInterface $product);
}
