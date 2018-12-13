<?php

namespace App\Domain\Request;

class ProductsListRequest implements RequestInterface
{
    /** @var array|null */
    private $orderBy;

    /** @var integer|null */
    private $limit;

    /** @var integer|null */
    private $offset;

    /**
     * ProductsListRequest constructor.
     * @param array|null $orderBy
     * @param int|null $limit
     * @param int|null $offset
     */
    public function __construct(?array $orderBy, ?int $limit, ?int $offset)
    {
        $this->orderBy = $orderBy;
        $this->limit = $limit;
        $this->offset = $offset;
    }

    /**
     * @return array|null
     */
    public function getOrderBy(): ?array
    {
        return $this->orderBy;
    }

    /**
     * @return int|null
     */
    public function getLimit(): ?int
    {
        return $this->limit;
    }

    /**
     * @return int|null
     */
    public function getOffset(): ?int
    {
        return $this->offset;
    }
}