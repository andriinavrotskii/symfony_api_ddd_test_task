<?php

namespace App\Domain\Request;

use Symfony\Component\Validator\Constraints as Assert;

class ProductsListRequest implements RequestInterface
{
    /**
     * @var array|null
     */
    private $orderBy;

    /**
     * @var int|null
     * @Assert\Type(type="integer", message="Limit must be an integer")
     * @Assert\GreaterThan(value="0", message="Limit id should be greater than zero")
     */
    private $limit;

    /**
     * @var int|null
     * @Assert\Type(type="integer", message="Offset must be an integer")
     */
    private $offset;

    /**
     * ProductsListRequest constructor.
     * @param array|null $orderBy
     * @param null $limit
     * @param null $offset
     */
    public function __construct(array $orderBy = null, $limit = null, $offset = null)
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
        return (int) $this->limit;
    }

    /**
     * @return int|null
     */
    public function getOffset(): ?int
    {
        return (int) $this->offset;
    }
}