<?php

namespace App\Domain\Repository;

use App\Domain\Model\SelectedProduct;

interface SelectedProductRepositoryInterface
{
    const ENTITY = SelectedProduct::class;

    /**
     * @param $id
     * @return SelectedProduct
     */
    public function find($id);

    /**
     * @return SelectedProduct[]
     */
    public function findAll();

    /**
     * @param mixed[]       $criteria
     * @param string[]|null $orderBy
     * @param int|null      $limit
     * @param int|null      $offset
     *
     * @return SelectedProduct[]
     */
    public function findBy(array $criteria, ?array $orderBy = null, $limit = null, $offset = null);

    /**
     * @param mixed[] $criteria The criteria.
     *
     * @return SelectedProduct|null
     */
    public function findOneBy(array $criteria);
}
