<?php

namespace App\Domain\Model;

use App\Domain\ValueObject\Money;

class SelectedProduct extends BaseEntity
{
    /** @var Receipt */
    private $receipt;

    /** @var Product */
    private $product;

    /** @var Money */
    private $cost;

    /** @var int */
    private $amount;

    /**
     * SelectedProduct constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->amount = 1;
    }

    /**
     * @return Receipt
     */
    public function getReceipt(): Receipt
    {
        return $this->receipt;
    }

    /**
     * @param Receipt $receipt
     */
    public function setReceipt(Receipt $receipt): void
    {
        $this->receipt = $receipt;
    }

    /**
     * @return Product
     */
    public function getProduct(): Product
    {
        return $this->product;
    }

    /**
     * @param Product $product
     */
    public function setProduct(Product $product): void
    {
        $this->product = $product;
        $this->cost = $product->getCost();
    }

    /**
     * @return Money
     */
    public function getCost(): Money
    {
        return $this->cost;
    }

    /**
     * @param Money $cost
     */
    public function setCost(Money $cost): void
    {
        $this->cost = $cost;
    }

    /**
     * @return int
     */
    public function getAmount(): int
    {
        return $this->amount;
    }

    /**
     * @param int $amount
     */
    public function setAmount(int $amount): void
    {
        $this->amount = $amount;
    }

    public function __toString()
    {
        return "Selected Product {$this->id} Product: {$this->product->getId()}";
    }
}
