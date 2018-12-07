<?php

namespace App\Domain\Repository;

use App\Domain\Model\Receipt;

interface ReceiptRepositoryInterface
{
    const ENTITY = Receipt::class;

    /**
     * @param $id
     * @return Receipt
     */
    public function find($id);

    /**
     * @return Receipt[]
     */
    public function findAll();

    /**
     * @param mixed[]       $criteria
     * @param string[]|null $orderBy
     * @param int|null      $limit
     * @param int|null      $offset
     *
     * @return Receipt[]
     */
    public function findBy(array $criteria, ?array $orderBy = null, $limit = null, $offset = null);

    /**
     * @param mixed[] $criteria The criteria.
     *
     * @return Receipt|null
     */
    public function findOneBy(array $criteria);
}
